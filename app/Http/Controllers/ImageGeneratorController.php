<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGeneratorService;

class ImageGeneratorController extends Controller
{
    protected $imageGeneratorService;
    public function __construct(ImageGeneratorService $imageGeneratorService)
    {
        $this->imageGeneratorService = $imageGeneratorService;
    }

    public function index()
    {
        $image = $this->imageGeneratorService->generate();
        return $image->response('jpg');
    }
}
