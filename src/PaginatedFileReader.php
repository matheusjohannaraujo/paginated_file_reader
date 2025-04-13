<?php

namespace MJohann\Packlib;

use MJohann\Packlib\Interfaces\PaginatedFileReaderInterface;
use MJohann\Packlib\Readers\DocxFileReader;
use MJohann\Packlib\Readers\OdtFileReader;
use MJohann\Packlib\Readers\PdfFileReader;
use MJohann\Packlib\Readers\TextFileReader;

class PaginatedFileReader
{
    private PaginatedFileReaderInterface $reader;
    private int $currentPage = 0;

    public function __construct(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File not found: $filePath");
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $this->reader = match ($extension) {
            'txt', 'md' => new TextFileReader($filePath),
            'pdf'       => new PdfFileReader($filePath),
            'docx'      => new DocxFileReader($filePath),
            'odt'       => new OdtFileReader($filePath),
            default     => throw new \Exception("Unsupported file format: $extension")
        };
    }

    public function readPage(int $pageNumber): string
    {
        $this->currentPage = $pageNumber;
        return $this->reader->readPage($pageNumber);
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getNextPage(): ?int
    {
        $total = $this->reader->getTotalPages();
        return ($this->currentPage + 1 < $total) ? $this->currentPage + 1 : null;
    }

    public function getTotalPages(): int
    {
        return $this->reader->getTotalPages();
    }
}
