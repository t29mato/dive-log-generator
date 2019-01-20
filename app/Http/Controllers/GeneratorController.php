<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ImageGeneratorService;
use App\Models\DivingLog;
use Illuminate\Support\Facades\Storage;

class GeneratorController extends Controller
{
    protected $imageGeneratorService;
    protected $divingLog;
    public function __construct(ImageGeneratorService $imageGeneratorService, DivingLog $divingLog)
    {
        $this->imageGeneratorService = $imageGeneratorService;
        $this->divingLog = $divingLog;
    }

    public function index(Request $oldInput)
    {
        return view('generate', ['oldInput' => $oldInput]);
    }

    public function generate(Request $request)
    {
        $this->validate($request, DivingLog::$rules);
        $this->divingLog->setDivingLog($request);
        $imageUrl = $this->imageGeneratorService->generate($this->divingLog);
        $oldInput = $request;

        return view('generate',[
            'imageUrl' => $imageUrl,
            'oldInput' => $oldInput,
        ]);
    }

    public function upload(Request $request)
    {

    }
}
