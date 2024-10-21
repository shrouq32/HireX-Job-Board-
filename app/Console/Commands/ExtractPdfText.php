<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PdfDocument;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Str;

class ExtractPdfText extends Command
{
    protected $signature = 'extract:pdf-text';

    protected $description = 'Extract text from a specific PDF and store it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Path to the specific PDF file
        $pdfFile = public_path('pdf/mamunur.pdf'); // Correct path to the PDF file

        // Check if the file exists
        if (!file_exists($pdfFile)) {
            $this->info('PDF file not found in the directory.');
            return;
        }

        $this->info("Processing file: {$pdfFile}");

        try {
            // Extract text from PDF
            $pdfText = Pdf::getText($pdfFile);
            $this->info("Text extracted from {$pdfFile}.");
        } catch (\Exception $e) {
            $this->error("Error extracting text from {$pdfFile}: " . $e->getMessage());
            return;
        }

        // Use a valid job_id from your jobs table
        $jobId = 5; // Update this to a valid job ID, e.g., 5 from the screenshot

        // Store extracted text in the database
        PdfDocument::updateOrCreate(
            ['title' => pathinfo($pdfFile, PATHINFO_FILENAME)], // Using title to ensure no duplicates
            [
                'job_id' => $jobId,
                'content' => Str::limit($pdfText, 60000), // Limit content to prevent exceeding column size
            ]
        );

        $this->info("Text extracted and saved for PDF: {$pdfFile}");
    }
}
