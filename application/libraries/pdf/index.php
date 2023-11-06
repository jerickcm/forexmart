<?php
require_once('pdfwatermarker/pdfwatermarker.php');
require_once('pdfwatermarker/pdfwatermark.php');

//Specify path to image. The image must have a 96 DPI resolution.
$watermark = new PDFWatermark('E:\xampp\htdocs\fx\assets\images\watermark.png'); 

//Set the position
$watermark->setPosition('center');

//Place watermark behind original PDF content. Default behavior places it over the content.
//$watermark->setAsBackground();

//Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
$watermarker = new PDFWatermarker('D:\test1.pdf','D:\test3.pdf',$watermark); 

//Set page range. Use 1-based index.
$watermarker->setPageRange(1);

//Save the new PDF to its specified location
$watermarker->savePdf(); 
?>