<?php

/* Background */
$img_file = 'img/cover_page/cp_cedap.jpg';

/* Construção do PDF */
tcpdf();

$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// PAGE 1 - BIG background image
$pdf -> AddPage();
$pdf -> SetAutoPageBreak(false, 0);

/* Background */
if (isset($img_file)) {
	$pdf -> Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
}
// Texto do certificado
//$pdf -> SetFont('helvetica', '', 16);
$pdf -> SetTextColor(128, 128, 128);
//$pdf -> SetTextColor(0, 0, 0);

$pdf -> SetXY(10, 40);
$pdf -> writeHTMLCell(0, 0, '', '', $content, 0, 2, 0, false, 'J', false);

/* Arquivo de saida */
$nome_asc = UpperCaseSql('11111');
//$nome_asc = troca($nome_asc,' ','_');
$pdf -> Output('certificado-' . $nome_asc . '.pdf', 'I');
?>