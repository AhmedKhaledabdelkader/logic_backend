<?php

namespace App\Services;

class MediaService
{

       public function show($filename)
    {
   
        if (ob_get_level()) {
            ob_end_clean();
        }
        
        $path = storage_path("app/private/{$filename}");

        if (!file_exists($path)) {
            return response()->json(['message' => 'Media not found'], 404);
        }
        
        return response()->file($path, [
            'Content-Type' => mime_content_type($path),
        ]);


    }




}