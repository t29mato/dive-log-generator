<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeneratorService;
use App\Models\DivingLog;
use Illuminate\Support\Facades\Storage;

class GeneratorController extends Controller
{
    protected $generatorService;
    protected $divingLog;
    public function __construct(GeneratorService $generatorService, DivingLog $divingLog)
    {
        $this->generatorService = $generatorService;
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
        $imageUrl = $this->generatorService->generate($this->divingLog, $request->template);
        $oldInput = $request;

        return view('generate',[
            'imageUrl' => $imageUrl,
            'oldInput' => $oldInput,
        ]);
    }
}
