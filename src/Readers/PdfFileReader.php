<?php

namespace MJohann\Packlib\Readers;

use MJohann\Packlib\Interfaces\PaginatedFileReaderInterface;
use Smalot\PdfParser\Parser as PdfParser;

class PdfFileReader implements PaginatedFileReaderInterface
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function readPage(int $pageNumber): string
    {
        $parser = new PdfParser();
        $document = $parser->parseFile($this->filePath);
        $pages = $document->getPages();

        return $pages[$pageNumber]->getText()
            ?? throw new \Exception("PDF page not found: $pageNumber");
    }

    public function getTotalPages(): int
    {
        $parser = new PdfParser();
        $document = $parser->parseFile($this->filePath);
        return count($document->getPages());
    }
}
