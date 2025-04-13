<?php

namespace App;

use App\Interfaces\PaginatedFileReaderInterface;
use App\Readers\DocxFileReader;
use App\Readers\OdtFileReader;
use App\Readers\PdfFileReader;
use App\Readers\TextFileReader;

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
