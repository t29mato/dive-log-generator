<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGeneratorService;
use App\DivingLog;
use Illuminate\Support\Facades\Storage;

class ImageGeneratorController extends Controller
{
    protected $imageGeneratorService;
    protected $divingLog;
    public function __construct(ImageGeneratorService $imageGeneratorService, DivingLog $divingLog)
    {
        $this->imageGeneratorService = $imageGeneratorService;
        $this->divingLog = $divingLog;
    }

    public function index()
    {
        return view('index');
    }

    public function generate(Request $request)
    {
        $this->divingLog->setDivingLog(
            $request->timeEntry,
            $request->timeExit,
            $request->timeDive,
            $request->tempTop,
            $request->tempBottom,
            $request->depthAvg,
            $request->depthMax,
            $request->pressureEntry,
            $request->pressureExit
        );
        $image = $this->imageGeneratorService->generate($this->divingLog);
        $filename = 'photos/temp/' . uniqid() . '.jpg';
        $image->save($filename);
        $imageUrl = url($filename);


        return view('index',[
            'hoge' => 'hoge',
            'imageUrl' => $imageUrl
        ]);
    }
}
