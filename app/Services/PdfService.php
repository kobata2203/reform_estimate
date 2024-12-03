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
        $construction_list = $this->constructionList->getById($id);
        $estimate_info = $this->estimateInfo->fetchEstimateInfoById($id);
        $breakdown = $this->breakdown->getBreakdownsByEstimateId($id);
        $estimate_calculation = $this->estimateCalculate->fetchCalculationByEstimateId($id);

        $discount = $estimate_calculation ? $estimate_calculation->special_discount : 0;

        // Calculate totals
        $totalAmount = $breakdown->sum('amount');
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Render the Blade view to HTML
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

        $pdfView = view('tcpdf.pdf.cover', compact(
            'estimate_info',
            'grandTotal',
            'breakdown'
        ))->render();

        return $this->pdfConfig($pdfView, 'Reform_Estimate_cover.pdf');
    }


    //calling from the utilities
    private function pdfConfig($html, $filename)
    {
        $mpdf = MpdfService::create();
        $mpdf->SetFont('ipaexg');
        $mpdf->WriteHTML($html);

        return $mpdf->Output($filename, 'I');
    }


    // private function pdfconfig($html, $filename)
    // {
    //     $config = config('mpdf');
    //     $mpdf = new Mpdf([
    //         'mode' => $config['mode'],
    //         'format' => $config['format'],
    //         'autoLangToFont' => $config['autoLangToFont'],
    //     ]);

    //     $mpdf->SetFont('ipaexg');
    //     $mpdf->WriteHTML($html);

    //     return $mpdf->Output($filename, 'I');
    // }

    // using multiple function
    // private function initializeMpdf($config)
    // {
    //     return new Mpdf([
    //         'mode' => $config['mode'],
    //         'format' => $config['format'],
    //         'autoLangToFont' => $config['autoLangToFont'],
    //     ]);
    // }

    // // Function to configure and generate PDF
    // private function generatePdf($mpdf, $html)
    // {
    //     $mpdf->SetFont('ipaexg');
    //     $mpdf->WriteHTML($html);
    //     return $mpdf;
    // }

    // // Main function to output PDF
    // private function pdfconfig($html, $filename)
    // {
    //     $config = config('mpdf');
    //     $mpdf = $this->initializeMpdf($config);  // Pass config as argument
    //     $mpdf = $this->generatePdf($mpdf, $html); // Pass mPDF object and HTML as arguments
    //     return $mpdf->Output($filename, 'I');    // Return the output
    // }

}
