<?php
require_once('lib/tcpdf/tcpdf.php');
require_once('/Applications/XAMPP/xamppfiles/htdocs/reform_estimate/resources/views/tcpdf/TCPDF-main/tcpdf.php');

$pdf = new setasign\Fpdi\Tcpdf\Fpdi("L", "mm", "A4", true, "UTF-8" );

$pdf->setPrintHeader( false );

$pdf->setSourceFile("breakdown.pdf");
$pdf->AddPage();
$tpl = $pdf->importPage(1);
$pdf->useTemplate($tpl);


$number = $_POST["number"];
$name = $_POST["name"];
$price = $_POST["price"];
$proviso = $_POST["proviso"];

//$pdf->SetFont('kozminproregular', スタイル, サイズ);
//$pdf->Text(x座標, y座標, テキスト);

//No.
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(150, 11, htmlspecialchars( $number ) );

//名前
$pdf->SetFont('kozminproregular', '', 20);
$pdf->Text(15, 35, htmlspecialchars( $name ) );

//金額
$pdf->SetFont('kozminproregular', '', 20);
$price = number_format($price) . "-";
$pdf->Text(70, 70, htmlspecialchars( $price ) );

//但し書き
$pdf->SetFont('kozminproregular', '', 11);
$pdf->Text(70, 85, htmlspecialchars( $proviso ) );

//日付
$pdf->SetFont('kozminproregular', '', 11);
$today = date("Y年m月d日");
$pdf->Text(150, 21, $today);

//$pdf->Output(出力時のファイル名, 出力モード);
$pdf->Output("output.pdf", "I");

$pdf2 = new setasign\Fpdi\Tcpdf\Fpdi("L", "mm", "A4", true, "UTF-8" );

$pdf2->setPrintHeader( false );

$pdf2->setSourceFile("breakdown.pdf");
$pdf2->AddPage();
$tpl2 = $pdf2->importPage(2);
$pdf2->useTemplate($tpl2);


$number = $_POST["number"];
$name = $_POST["name"];
$price = $_POST["price"];
$proviso = $_POST["proviso"];

//$pdf->SetFont('kozminproregular', スタイル, サイズ);
//$pdf->Text(x座標, y座標, テキスト);

//No.
$pdf2->SetFont('kozminproregular', '', 11);
$pdf2->Text(150, 11, htmlspecialchars( $number ) );

//名前
$pdf2->SetFont('kozminproregular', '', 20);
$pdf2->Text(15, 35, htmlspecialchars( $name ) );

//金額
$pdf2->SetFont('kozminproregular', '', 20);
$price = number_format($price) . "-";
$pdf2->Text(70, 70, htmlspecialchars( $price ) );

//但し書き
$pdf2->SetFont('kozminproregular', '', 11);
$pdf2->Text(70, 85, htmlspecialchars( $proviso ) );

//日付
$pdf2->SetFont('kozminproregular', '', 11);
$today = date("Y年m月d日");
$pdf2->Text(150, 21, $today);

//$pdf->Output(出力時のファイル名, 出力モード);
$pdf2->Output("output.pdf", "I");
