<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Request;



class MediaController extends Controller
{
      public $mediaService ;

    public function __construct(MediaService $mediaService) {
        $this->mediaService = $mediaService;
    }

    public function show($filename){


        return $this->mediaService->show($filename);

    }
}
