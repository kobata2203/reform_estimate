<?php
require_once('lib/tcpdf/tcpdf.php');
require_once('lib/tcpdf/fpdi/autoload.php');

$pdf = new setasign\Fpdi\Tcpdf\Fpdi("L", "mm", "A4", true, "UTF-8" );

$pdf->setPrintHeader( false );

$pdf->setSourceFile("cover.pdf");
$pdf->AddPage();
$tpl = $pdf->importPage(1);
$pdf->useTemplate($tpl);



$customer_name = $_POST["customer_name"];
$price = $_POST["price"];
$charger_name = $_POST["charger_name"];
$subject_name = $_POST["subject_name"];
$delivery_place = $_POST["delivery_place"];
$construction_period = $_POST["construction_period"];
$payment_type = $_POST["payment_type"];

//$pdf->SetFont('kozminproregular', スタイル, サイズ);
//$pdf->Text(x座標, y座標, テキスト);



//お客様名
$pdf->SetFont('kozminproregular', '', 20);
$pdf->Text(50, 68, htmlspecialchars( $customer_name ) );

//金額
$pdf->SetFont('kozminproregular', '', 20);
$price = number_format($price) . "-";
$pdf->Text(150, 95, htmlspecialchars( $price ) );

//担当者名
$pdf->SetFont('kozminproregular', '', 15);
$pdf->Text(225, 175, htmlspecialchars( $charger_name ) );

//日付
$pdf->SetFont('kozminproregular', '', 11);
$today = date("Y年m月d日");
$pdf->Text(250, 53, $today);

//件名
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(45, 118, htmlspecialchars( $subject_name ) );

//納入場所
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(45, 124.5, htmlspecialchars( $delivery_place ) );

//工期
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(45, 131, htmlspecialchars( $construction_period ) );

//支払方法
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(45, 137, htmlspecialchars( $payment_type ) );

//$pdf->Output(出力時のファイル名, 出力モード);
$pdf->Output("output.pdf", "I");

