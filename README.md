
# [📄 Paginated File Reader](https://github.com/matheusjohannaraujo/paginated_file_reader)

A PHP library to read files page by page, supporting multiple formats like **TXT**, **PDF**, **DOCX**, and **ODT**. Each file type is handled by a dedicated reader class, all following a unified interface for seamless integration.

## 📦 Installation

You can install the library via Composer:

```bash
composer require mjohann/paginated-file-reader
```

## ⚙️ Requirements

- PHP 8.0 or higher

## 🚀 Features

- Read files page by page (pagination logic varies by file type)
- Supported formats:
  - `.txt` and `.md` (50 lines per page)
  - `.pdf` (using `smalot/pdfparser`)
  - `.docx` (using `phpoffice/phpword`)
  - `.odt` (using native `ZipArchive`)
- Easily extendable for other file types
- Unified interface for all readers

## 🧪 Usage Example

```php
<?php

require 'vendor/autoload.php';

use MJohann\Packlib\PaginatedFileReader;

$reader = new PaginatedFileReader('path/to/your/file.pdf');

// Read page 0
echo $reader->readPage(0);

// Get total pages
echo $reader->getTotalPages();
```

For more examples, see the [`example/script.php`](example/script.php) file in the repository.

## 📁 Project Structure

```
project/
├── src/
│   ├── Interfaces/
│   │   └── PaginatedFileReaderInterface.php
│   ├── Readers/
│   │   ├── TextFileReader.php
│   │   ├── PdfFileReader.php
│   │   ├── DocxFileReader.php
│   │   └── OdtFileReader.php
│   └── PaginatedFileReader.php
├── example/
│   └── script.php
├── composer.json
├── .gitignore
├── LICENSE
└── README.md
```

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## 👨‍💻 Author

Developed by [Matheus Johann Araújo](https://github.com/matheusjohannaraujo) – Pernambuco, Brazil.
