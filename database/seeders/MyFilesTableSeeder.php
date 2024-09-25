<?php

namespace Database\Seeders;

use App\Models\MyFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for seeding
        $files = [
            [
                'user_id' => 1,
                'name' => 'document1.pdf',
                'path' => 'uploads/documents/document1.pdf',
                'extension' => 'pdf',
                'size' => 2048, // size in bytes
            ],
            [
                'user_id' => 2,
                'name' => 'image1.jpg',
                'path' => 'uploads/images/image1.jpg',
                'extension' => 'jpg',
                'size' => 102400,
            ],
            [
                'user_id' => 1,
                'name' => 'presentation.pptx',
                'path' => 'uploads/presentations/presentation.pptx',
                'extension' => 'pptx',
                'size' => 51200,
            ],
            [
                'user_id' => 3,
                'name' => 'spreadsheet.xlsx',
                'path' => 'uploads/spreadsheets/spreadsheet.xlsx',
                'extension' => 'xlsx',
                'size' => 307200,
            ],
        ];

        foreach ($files as $file) {
            MyFile::create(array_merge($file, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }}
