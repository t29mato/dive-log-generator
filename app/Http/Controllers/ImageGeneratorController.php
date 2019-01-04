<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGeneratorService;
use Illuminate\Support\Facades\Storage;

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

    public function generate(Request $request)
    {
        $image = $this->imageGeneratorService->generate();
        $filename = 'photos/temp/' . uniqid() . '.jpg';
        $image->save($filename);
        $imageUrl = Storage::url($filename);

        \Log::debug($imageUrl);
        return view('index',[
            'hoge' => 'hoge',
            'imageUrl' => $imageUrl
        ]);
    }
}
