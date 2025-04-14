
# [📄 Paginated File Reader](https://github.com/matheusjohannaraujo/paginated_file_reader)

A PHP library to read files page by page, supporting multiple formats like **TXT**, **PDF**, **DOCX**, and **ODT**. Each file type is handled by a dedicated reader class, all following a unified interface for seamless integration.

---

## 🚀 Features

- Read files page by page (pagination logic varies by file type)
- Supported formats:
  - `.txt` and `.md` (50 lines per page)
  - `.pdf` (using `smalot/pdfparser`)
  - `.docx` (using `phpoffice/phpword`)
  - `.odt` (using native `ZipArchive`)
- Easily extendable for other file types
- Unified interface for all readers

---

## 🛠️ Installation

1. **Clone the project** or **add it to your project**.
2. Run Composer to install dependencies and autoload:

```bash
composer install
composer require mjohann/paginated-file-reader
```

---

## ✅ Usage Example

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

---

## 🧱 Project Structure

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
├── composer.json
├── .gitignore
├── LICENSE
└── README.md
```

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## 👨‍💻 Author

Developed by [Matheus Johann Araújo](https://github.com/matheusjohannaraujo) – Pernambuco, Brazil.
