<?php

namespace App\Services;

use App\Models\Breakdown;
use App\Models\EstimateCalculate;
use App\Models\EstimateInfo;
use TCPDF;

class PdfService
{
    protected $estimateInfo;
    protected $breakdown;
    protected $estimateCalculate;

    public function __construct(
        EstimateInfo $estimateInfo,
        Breakdown $breakdown,
        EstimateCalculate $estimateCalculate
    ) {
        $this->estimateInfo = $estimateInfo;
        $this->breakdown = $breakdown;
        $this->estimateCalculate = $estimateCalculate;
    }

    public function generatePdf($id): string
    {
        // Fetch data
        $data = $this->fetchData($id);

        // Create PDF instance
        $pdf = $this->initializePdf();

        // Add title and headers
        $this->addTitle($pdf, $data['estimate_info']);

        // Add breakdown table
        $totalAmount = $this->addBreakdownTable($pdf, $data['breakdown']);

        // Add totals and calculations
        $this->addTotals($pdf, $totalAmount, $data['discount']);

        // Output PDF
        return $pdf->Output("output.pdf", "I");
    }

    protected function fetchData($id): array
    {
        return [
            'estimate_info' => $this->estimateInfo->fetchEstimateInfoById($id),
            'breakdown' => $this->breakdown->getBreakdownsByEstimateId($id),
            'discount' => optional($this->estimateCalculate->fetchCalculationByEstimateId($id))->special_discount ?? 0,
        ];
    }

    // Create PDF instance
    protected function initializePdf()
    {
        $pdf = new TCPDF("P", "mm", "A4", true, "UTF-8");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->AddFont('kozgopromedium', '', 'kozgopromedium.php');
        $pdf->SetFont('kozgopromedium', '', 12);
        return $pdf;
    }

    // Add title and headers
    protected function addTitle($pdf, $estimateInfo)
    {
        $pdf->Cell(0, 10, '内訳明細書', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, '株式会社サーバントップ', 0, 1, 'R');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, '工事名: ' . $estimateInfo->construction_name, 0, 1);
    }

    // Add breakdown table
    protected function addBreakdownTable($pdf, $breakdown)
    {
        $pdf->SetX(5);
        $pdf->SetFillColor(220, 220, 220);
        $this->addTableHeader($pdf);

        $totalAmount = 0;

        foreach ($breakdown as $item) {
            $totalAmount += $item->amount;
            $this->addTableRow($pdf, $item);
        }

        return $totalAmount;
    }

    protected function addTableHeader($pdf)
    {
        $pdf->Cell(20, 10, '項目', 1, 0, 'C', true);
        $pdf->Cell(70, 10, '仕様・摘要', 1, 0, 'C', true);
        $pdf->Cell(15, 10, '数量', 1, 0, 'C', true);
        $pdf->Cell(10, 10, '単位', 1, 0, 'C', true);
        $pdf->Cell(15, 10, '単価', 1, 0, 'C', true);
        $pdf->Cell(25, 10, '金額', 1, 0, 'C', true);
        $pdf->Cell(45, 10, '備考', 1, 1, 'C', true);
    }

    protected function addTableRow($pdf, $item)
    {
        $pdf->SetX(5);
        $pdf->Cell(20, 10, $item->construction_item, 1, 0, 'C');
        $pdf->Cell(70, 10, $item->specification, 1, 0, 'C');
        $pdf->Cell(15, 10, $item->quantity, 1, 0, 'C');
        $pdf->Cell(10, 10, $item->unit, 1, 0, 'C');
        $pdf->Cell(15, 10, number_format($item->unit_price), 1, 0, 'C');
        $pdf->Cell(25, 10, '¥ ' . number_format($item->amount), 1, 0, 'C');
        $pdf->Cell(45, 10, $item->remarks, 1, 1, 'C');
    }

    protected function addTotals($pdf, $totalAmount, $discount)
    {
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        $pdf->SetX(5);
        $pdf->Cell(130, 10, '特別お値引き ', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($discount), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '小計（税抜）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($subtotal), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '消費税（10%）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($tax), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '合計（税込）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($grandTotal), 1, 1, 'C');
    }
}
