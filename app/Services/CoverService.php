<?php

namespace App\Services;

use Mpdf\Mpdf;
use App\Models\Breakdown;
use App\Models\EstimateInfo;
use App\Models\EstimateCalculate;


class CoverService
{
    public function getEstimateInfoById($id)
    {
        return EstimateInfo::findOrFail($id);
    }

    public function getBreakdownsByEstimateId($id)
    {
        return Breakdown::where('estimate_id', $id)->get();
    }

    public function getEstimateCalculation($id)
    {
        return EstimateCalculate::where('estimate_id', $id)->first();
    }

    public function calculateTotals($breakdown, $discount)
    {
        $totalAmount = $breakdown->sum('amount');
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        return [
            'totalAmount' => $totalAmount,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
        ];
    }

    public function generatePDF($estimateInfo, $grandTotal, $breakdown)
    {
        $pdfView = view('tcpdf.cover', [
            'estimate_info' => $estimateInfo,
            'grandTotal' => $grandTotal,
            'breakdown' => $breakdown,
        ])->render();


        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        $mpdf->WriteHTML($pdfView);

        return $mpdf->Output('Reform_Estimate_breakdown.pdf', 'I');
    }





}
