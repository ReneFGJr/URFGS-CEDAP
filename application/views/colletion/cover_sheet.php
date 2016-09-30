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
$pdf -> SetFont('courier', '', 16);
$pdf -> SetTextColor(128, 128, 128);
//$pdf -> SetTextColor(0, 0, 0);

$pdf -> SetXY(10, 40);
$cont = '<table width="100%">';
$cont .= '<tr valign="top"><td width="50%">'.$content.'</td><td width="50%">'.$metadata.'</td></tr>';
$cont .= '</table>';
$pdf -> writeHTMLCell(0, 0, '', '', $cont, 0, 2, 0, false, 'L', false);

/* Logo */
$img_file = 'img/logo/logo_png.jpg';
if (isset($img_file)) {
	$pdf -> Image($img_file, 120, 270,70,0, '', '', '', false, 300, '', false, false, 0);
}



$pdf -> SetFont('courier', '', 8);
$content = '<b>Universidade Federal do Rio Grande do Sul</b><br>';
$content .= 'Faculdade de Biblioteconomia e Comunicação – FABICO<br>';
$content .= 'Centro de Documentação e Acervo Digital da Pesquisa – CEDAP<br>';
$content .= 'Porto Alegre - RS - CEP 90035-007<br>';
$content .= 'Telefone: (51) 3308.5942<br>';
$content .= 'www.ufrgs.br/cedap   E-mail: cedap@ufrgs.br<br>';

$pdf -> SetXY(10, 270);
$pdf -> writeHTMLCell(0, 0, '', '', $content, 0, 2, 0, false, 'J', false);

/* Arquivo de saida */
$nome_asc = UpperCaseSql('11111');
//$nome_asc = troca($nome_asc,' ','_');
$pdf -> Output('certificado-' . $nome_asc . '.pdf', 'I');
?>