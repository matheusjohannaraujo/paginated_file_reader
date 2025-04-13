<?php

require '../vendor/autoload.php';

use App\PaginatedFileReader;

$reader = new PaginatedFileReader('document.pdf');
echo "PDF:", PHP_EOL;
echo "Pages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.docx');
echo "DOCX:", PHP_EOL;
echo "Pages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.odt');
echo "ODT:", PHP_EOL;
echo "Pages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;

$reader = new PaginatedFileReader('document.txt');
echo "TXT:", PHP_EOL;
echo "Pages: ", $reader->getTotalPages(), PHP_EOL;
echo $reader->readPage(0), PHP_EOL, PHP_EOL;
