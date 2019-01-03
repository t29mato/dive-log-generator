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
        return view('index');
    }

    public function generate()
    {
        $image = $this->imageGeneratorService->generate();
        return $image->response('jpg');
    }
}
