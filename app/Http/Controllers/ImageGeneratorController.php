<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ImageGeneratorService;
use App\Models\DivingLog;
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

    public function index(DivingLog $divingLog)
    {
        return view('index', ['divingLog' => $divingLog]);
    }

    public function generate(Request $request)
    {
        $this->validate($request, DivingLog::$rules);
        $this->divingLog->setDivingLog($request);
        $imageUrl = $this->imageGeneratorService->generate($this->divingLog);

        return view('index',[
            'imageUrl' => $imageUrl,
            'divingLog' => $this->divingLog,
        ]);
    }
}
