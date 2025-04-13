<?php

namespace MJohann\Packlib\Readers;

use MJohann\Packlib\Interfaces\PaginatedFileReaderInterface;
use PhpOffice\PhpWord\IOFactory;

class DocxFileReader implements PaginatedFileReaderInterface
{
    private string $filePath;
    private ?array $pages = null;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function readPage(int $pageNumber): string
    {
        $pages = $this->extractPages();
        return $pages[$pageNumber]
            ?? throw new \Exception("DOCX page not found: $pageNumber");
    }

    public function getTotalPages(): int
    {
        return count($this->extractPages());
    }

    private function extractPages(): array
    {
        if ($this->pages !== null) return $this->pages;

        $phpWord = IOFactory::load($this->filePath, 'Word2007');
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }

        $words = preg_split('/\s+/', $text);
        $chunks = array_chunk($words, 500); // Artificial paging
        return $this->pages = array_map(fn($chunk) => implode(' ', $chunk), $chunks);
    }
}
