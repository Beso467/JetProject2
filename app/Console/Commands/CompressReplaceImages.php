<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CompressReplaceImages extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:compress-replace-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress and replace existing images';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
       $imagePaths = Storage::disk('public')->files('logos'); // Replace with your image directory path

       foreach ($imagePaths as $imagePath) {
        $image = Image::make(storage_path("app/public/{$imagePath}"));
        $image->encode('webp', 80); // Adjust quality as needed
        $image->save(storage_path("app/public/{$imagePath}")); // Overwrite the original image
    }

        $this->info('Images compressed and replaced successfully.');
    }
}

