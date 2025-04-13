<?php

namespace MJohann\Packlib\Interfaces;

interface PaginatedFileReaderInterface
{
    public function readPage(int $pageNumber): string;
    public function getTotalPages(): int;
}
