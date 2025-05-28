<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all JSON files from resources/json
        $jsonFiles = File::files(resource_path('json'));

        foreach ($jsonFiles as $file) {
            // Read JSON content
            $movieData = json_decode(file_get_contents($file->getPathname()), true);
            
            // Create movie record
            Movie::create($movieData);

            // Copy poster if it exists
            if (isset($movieData['poster_url'])) {
                $posterSource = Storage::disk('public')->path($movieData['poster_url']);
                $posterDest = Storage::disk('public')->path('posters/' . $movieData['poster_url']);
                
                if (!File::exists(dirname($posterDest))) {
                    File::makeDirectory(dirname($posterDest), 0755, true);
                }

                if (File::exists($posterSource)) {
                    File::copy($posterSource, $posterDest);
                }
            }
        }
    }
}
