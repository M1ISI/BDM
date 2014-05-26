<?php
include_once('pdf2txt.php');
$a = new PDF2Text();
$a->setFilename('sujet2013.pdf');
$a->decodePDF();
echo $a->output();
?>
