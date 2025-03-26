<?php

namespace App\Services;

use Mpdf\Mpdf;
use App\Models\Breakdown;
use App\Models\ConstructionList;
use App\Models\EstimateInfo;
use App\Utilities\MpdfService;
use App\Models\EstimateCalculate;

class PdfService
{
    protected $estimate_info;
    protected $breakdown;
    protected $estimate_calculate;
    protected $mpdf;
    protected $construction_list;



    public function __construct(
        EstimateInfo $estimate_info,
        Breakdown $breakdown,
        EstimateCalculate $estimate_calculate,
        Mpdf $mpdf,
        ConstructionList $construction_list,


    ) {
        $this->estimate_info = $estimate_info;
        $this->breakdown = $breakdown;
        $this->estimate_calculate = $estimate_calculate;
        $this->mpdf = $mpdf;
        $this->construction_list = $construction_list;

    }
    //breakdownテーブルのPDFの文字サイズ
    public function calculateFontSizeInController($text)
    {
        $length = strlen($text);
        $baseFontSize = 14;
        $fontSize = $baseFontSize - floor($length / 10);
        $fontSize = max($fontSize, 5);
        return $fontSize;
    }

    public function generateBreakdown($id, $construction_list_id)
    {
        // breakdownテーブルのPDFの文字サイズ
        $font_size = $this->calculateFontSizeInController("メーカー名・シリーズ名（商品名）・品番");

        // 工事名をestimate_info_idで呼び出し
        $construction_list = $this->construction_list->getByEstimateAndConstructionId($id, $construction_list_id);
        $estimate_info = $this->estimate_info->fetchEstimateInfoById($construction_list->estimate_info_id);
        $breakdown = $this->breakdown->getBreakdownsByConstructionId($construction_list_id);

        $estimate_calculation = $this->estimate_calculate->fetchCalculationByEstimateIdAndConstructionId($id, $construction_list_id);
        $discount = $estimate_calculation ? $estimate_calculation->special_discount : 0;

        // Calculate totals
        $totalAmount = $breakdown->sum('amount');
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        $html = view('tcpdf.pdf.breakdown', compact(
            'estimate_info',
            'breakdown',
            'discount',
            'totalAmount',
            'subtotal',
            'tax',
            'grandTotal',
            'construction_list',
            'font_size'
        ))->render();

        return $this->pdfConfig($html, 'reform_estimate_breakdown.pdf');
    }

    public function generateCover($id)
    {
        $estimate_info = $this->estimate_info->fetchEstimateInfoById($id);
        $construction_list = $this->construction_list->getByEstimateInfoId($id);
        $delivery_place = $estimate_info->delivery_place;
        $remarks = $estimate_info->remarks;

        $construction_text = implode($construction_list->pluck('name')->toArray());
        $delivery_text = implode([$delivery_place]);
        $remarks_text = implode([$remarks]);

        $font_size_construction = $this->calculateFontSize($construction_text);
        $font_size_delivery = $this->calculateFontSize($delivery_text);
        $font_size_remarks = $this->calculateFontSize($remarks_text);


        $font_size_construction = max($font_size_construction, 2);
        $font_size_delivery = max($font_size_delivery, 6);
        $font_size_remarks = max($font_size_remarks, 3);

        $totalAmount = 0;
        $totalDiscount = 0;
        $totalSubtotal = 0;
        $totalTax = 0;
        $totalGrandTotal = 0;

        foreach ($construction_list as $construction) {
            $breakdown = $this->breakdown::where('construction_list_id', $construction->id)->get();
            $amount = $breakdown->sum('amount');
            $discount = $this->estimate_calculate->getDiscountByEstimateIdAndConstructionId($id, $construction->id);
            $subtotal = $amount - $discount;
            $tax = $subtotal * 0.1;
            $grandTotal = $subtotal + $tax;

            $totalAmount += $amount;
            $totalDiscount += $discount;
            $totalSubtotal += $subtotal;
            $totalTax += $tax;
            $totalGrandTotal += $grandTotal;
        }

        // 件名の長さによって計算
        $font_size = $this->calculateFontSize($construction_text);

        $pdfView = view('tcpdf.pdf.cover', [
            'estimate_info' => $estimate_info,
            'totalGrandTotal' => $totalGrandTotal,
            'construction_list' => $construction_list,
            'font_size_construction' => $font_size_construction,
            'font_size_delivery' => $font_size_delivery,
            'font_size_remarks' => $font_size_remarks,
            'font_size' => $font_size, // 件名の変数,
        ])->render();

        return $this->pdfConfig($pdfView, 'Reform_Estimate_cover.pdf');
    }

    // 御見積書の件名の長さ
    private function calculateFontSize($text)
    {
        $length = strlen($text);
        $baseFontSize = 12;
        $fontSize = $baseFontSize - floor($length / 10);
        $fontSize = max($fontSize, 3);
        return $fontSize;
    }

    //　App/utilitiesから呼び出し
    private function pdfConfig($html, $filename)
    {
        $mpdf = MpdfService::create();
        $mpdf->SetFont('ipaexg');
        $mpdf->WriteHTML($html);

        return $mpdf->Output($filename, 'I');
    }

}
