<?php

namespace App\Readers;

use App\Interfaces\PaginatedFileReaderInterface;

class TextFileReader implements PaginatedFileReaderInterface
{
    private string $filePath;
    private int $linesPerPage = 50;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function readPage(int $pageNumber): string
    {
        $start = $pageNumber * $this->linesPerPage;
        $end = $start + $this->linesPerPage;

        $file = new \SplFileObject($this->filePath);
        $file->seek($start);

        $content = '';
        while (!$file->eof() && $file->key() < $end) {
            $content .= $file->fgets();
        }

        return $content;
    }

    public function getTotalPages(): int
    {
        $file = new \SplFileObject($this->filePath);
        $file->seek(PHP_INT_MAX);
        $totalLines = $file->key() + 1;

        return (int) ceil($totalLines / $this->linesPerPage);
    }
}
