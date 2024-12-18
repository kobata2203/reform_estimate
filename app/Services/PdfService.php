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
    protected $estimateInfo;
    protected $breakdown;
    protected $estimateCalculate;
    protected $mpdf;
    protected $constructionList;



    public function __construct(
        EstimateInfo $estimateInfo,
        Breakdown $breakdown,
        EstimateCalculate $estimateCalculate,
        Mpdf $mpdf,
        ConstructionList $constructionList,

    ) {
        $this->estimateInfo = $estimateInfo;
        $this->breakdown = $breakdown;
        $this->estimateCalculate = $estimateCalculate;
        $this->mpdf = $mpdf;
        $this->constructionList = $constructionList;
    }

    public function generateBreakdown($id)
    {
        $construction_list = $this->constructionList->getById($id);
        $estimate_info = $this->estimateInfo->fetchEstimateInfoById($id);
        $breakdown = $this->breakdown->getBreakdownsByEstimateId($id);
        $estimate_calculation = $this->estimateCalculate->fetchCalculationByEstimateId($id);

        $discount = $estimate_calculation ? $estimate_calculation->special_discount : 0;


        //合計金額の計算
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
            'construction_list'
        ))->render();

        return $this->pdfConfig($html, 'reform_estimate_breakdown.pdf');
    }

    public function generateCover($id)
    {
        $estimate_info = $this->estimateInfo->fetchingEstimateInfoById($id);
        $breakdown = $this->breakdown->fetchingBreakdownsByEstimateId($id);
        $totalAmount = $breakdown->sum('amount');

        $estimateCalculate = $this->estimateCalculate->fetchEstimateCalculateByEstimateId($id);
        $discount = $estimateCalculate ? $estimateCalculate->special_discount : 0;
        $inputDiscount = request()->input('discount', $discount);

        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
        $filtered_construction_list = $construction_list[$estimate_info->id] ?? [];

        // 件名の長さ
        $construction_text = implode($filtered_construction_list->pluck('name')->toArray());

        //件名の長さによって計算
        $font_size = $this->calculateFontSize($construction_text);

        $pdfView = view('tcpdf.pdf.cover', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'breakdown' => $breakdown,
            'construction_list' => $filtered_construction_list,
            'font_size' => $font_size, //件名の変数
        ])->render();

        return $this->pdfConfig($pdfView, 'Reform_Estimate_cover.pdf');
    }

    // 御見積書の件名の長さ
    private function calculateFontSize($text)
    {
        $length = strlen($text);
        $baseFontSize = 14;
        $fontSize = $baseFontSize - floor($length / 10);
        $fontSize = max($fontSize, 5);
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
