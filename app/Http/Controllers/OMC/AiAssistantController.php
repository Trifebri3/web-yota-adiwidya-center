<?php

namespace App\Http\Controllers\OMC;

use App\Http\Controllers\Controller;
use App\Services\AiContentService;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    protected AiContentService $aiService;

    public function __construct(AiContentService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Terjemahkan teks dari ID ke EN (atau sebaliknya)
     */
    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'source' => 'nullable|string',
            'target' => 'nullable|string',
        ]);

        $source = $request->input('source', 'id');
        $target = $request->input('target', 'en');
        $text = $request->input('text');

        $translated = $this->aiService->translate($text, $source, $target);

        return response()->json([
            'success' => true,
            'source' => $source,
            'target' => $target,
            'original' => $text,
            'translated' => $translated,
        ]);
    }

    /**
     * Otomatisasi generate metadata SEO
     */
    public function generateSeo(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
        ]);

        $seo = $this->aiService->generateSeo(
            $request->input('title'),
            $request->input('content', '')
        );

        return response()->json([
            'success' => true,
            'seo' => $seo,
        ]);
    }

    /**
     * Bantuan Penulisan & Ringkasan Konten
     */
    public function assist(Request $request)
    {
        $request->validate([
            'action' => 'required|string',
            'content' => 'required|string',
        ]);

        $result = $this->aiService->assist(
            $request->input('action'),
            $request->input('content')
        );

        return response()->json([
            'success' => true,
            'result' => $result,
        ]);
    }
}

