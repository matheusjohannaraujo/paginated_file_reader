<?php

namespace MJohann\Packlib\Readers;

use MJohann\Packlib\Interfaces\PaginatedFileReaderInterface;

class OdtFileReader implements PaginatedFileReaderInterface
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
            ?? throw new \Exception("ODT page not found: $pageNumber");
    }

    public function getTotalPages(): int
    {
        return count($this->extractPages());
    }

    private function extractPages(): array
    {
        if ($this->pages !== null) return $this->pages;

        $zip = new \ZipArchive();
        if ($zip->open($this->filePath) === true) {
            $xml = $zip->getFromName("content.xml");
            $zip->close();

            if (!$xml) {
                throw new \Exception("ODT content not found.");
            }

            $xml = strip_tags($xml);
            $pageBreak = '[PAGE_BREAK]';
            $xml = str_replace('<text:page-break/>', $pageBreak, $xml);

            return $this->pages = explode($pageBreak, $xml);
        }

        throw new \Exception("Failed to open ODT.");
    }
}
