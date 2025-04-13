<?php

require_once '../vendor/autoload.php';

use MJohann\Packlib\PaginatedFileReader;

$reader = new PaginatedFileReader('document.pdf');
echo "PDF | NumPages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.docx');
echo "DOCX | NumPages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.odt');
echo "ODT | NumPages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.txt');
echo "TXT | NumPages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;
