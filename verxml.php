<?php
include_once "php-barcode-generator/src/BarcodeGenerator.php";
include_once "php-barcode-generator/src/BarcodeGeneratorHTML.php";
include_once "php-barcode-generator/src/BarcodeGeneratorJPG.php";
include_once "php-barcode-generator/src/BarcodeGeneratorPNG.php";
include_once "php-barcode-generator/src/BarcodeGeneratorSVG.php";

use Picqer\Barcode\BarcodeGeneratorHTML;
$barhtml=new BarcodeGeneratorHTML();
echo $barhtml->getBarcode('123',$barhtml::TYPE_CODE_128);
?>