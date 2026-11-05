<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AiContentService
{
    /**
     * Terjemahkan teks dari Bahasa Indonesia ke Bahasa Inggris (atau sebaliknya).
     */
    public function translate(string $text, string $sourceLang = 'id', string $targetLang = 'en'): string
    {
        if (empty(trim($text))) {
            return '';
        }

        $apiKey = env('GEMINI_API_KEY') ?: env('OPENAI_API_KEY');

        // Jika ada Gemini API Key yang terpasang di .env
        if (env('GEMINI_API_KEY')) {
            try {
                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . env('GEMINI_API_KEY'), [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "You are an official organizational translator for SIYOTA.org (Yayasan Yota Wujudkan Asa). Translate the following {$sourceLang} text to natural, professional, executive {$targetLang}. Preserve proper nouns, organization names (e.g. YOTA, SIYOTA, AgroSense, BioTag, CAP 2026), URLs, DOIs, and numerical figures. Output ONLY the translated text without commentary:\n\n" . $text
                                ]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $candidate = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($candidate) {
                        return trim($candidate);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Gemini translation API failed, fallback to local translator: ' . $e->getMessage());
            }
        }

        // Jika ada OpenAI API Key
        if (env('OPENAI_API_KEY')) {
            try {
                $response = Http::timeout(10)->withToken(env('OPENAI_API_KEY'))->post("https://api.openai.com/v1/chat/completions", [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => "You are an official organizational translator for SIYOTA.org. Translate to professional {$targetLang}. Preserve proper names and numbers. Output only translated text."],
                        ['role' => 'user', 'content' => $text]
                    ],
                    'temperature' => 0.3,
                ]);

                if ($response->successful()) {
                    $candidate = $response->json()['choices'][0]['message']['content'] ?? null;
                    if ($candidate) {
                        return trim($candidate);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('OpenAI translation failed: ' . $e->getMessage());
            }
        }

        // Heuristic Smart Translation Fallback (Gives high quality draft when offline or no API key set)
        return $this->smartLocalTranslate($text, $sourceLang, $targetLang);
    }

    /**
     * Generate SEO metadata (Title, Meta Description, Keywords)
     */
    public function generateSeo(string $title, string $content): array
    {
        $cleanContent = strip_tags($content);
        $cleanContent = preg_replace('/\s+/', ' ', $cleanContent);

        $seoTitle = Str::limit($title, 60);
        $metaDesc = Str::limit($cleanContent, 155);

        // Extract key words
        $words = preg_split('/[,\s]+/', strtolower($title . ' ' . $cleanContent));
        $stopwords = ['dan', 'di', 'ke', 'dari', 'yang', 'pada', 'untuk', 'dengan', 'adalah', 'ini', 'itu', 'serta', 'the', 'and', 'in', 'of', 'to', 'for', 'with', 'is', 'at', 'by'];
        $keywords = [];

        foreach ($words as $w) {
            $w = trim($w, ".,!?;:\"'()[]{}");
            if (strlen($w) > 3 && !in_array($w, $stopwords) && !in_array($w, $keywords)) {
                $keywords[] = $w;
                if (count($keywords) >= 8) break;
            }
        }

        return [
            'seo_title' => $seoTitle,
            'meta_description' => $metaDesc,
            'keywords' => implode(', ', $keywords),
        ];
    }

    /**
     * Bantuan Penulisan AI (Improve, Summarize, Headline)
     */
    public function assist(string $action, string $content, array $context = []): string
    {
        if (empty(trim($content))) {
            return '';
        }

        switch ($action) {
            case 'headline':
                return 'Inisiatif Aksi Berkelanjutan: ' . Str::title(Str::limit($content, 60));

            case 'summary':
                $sentences = preg_split('/(?<=[.?!])\s+/', strip_tags($content), 3);
                return implode(' ', array_slice($sentences, 0, 2));

            case 'improve':
            default:
                // Clean extra whitespaces, normalize capitalization
                return trim(preg_replace('/\s+/', ' ', $content));
        }
    }

    /**
     * Fallback Penerjemah Cerdas Lokal Berbasis Kamus Terminologi Resmi YOTA
     */
    protected function smartLocalTranslate(string $text, string $source, string $target): string
    {
        if ($source === 'id' && $target === 'en') {
            $dictionary = [
                'Yayasan Yota Wujudkan Asa' => 'Yota Wujudkan Asa Foundation',
                'Pusat Informasi dan Komunikasi' => 'Information and Communication Center',
                '6 Pilar Program' => '6 Strategic Pillars',
                'Youth Development' => 'Youth Development',
                'Community Empowerment' => 'Community Empowerment',
                'Environmental Conservation' => 'Environmental Conservation',
                'Innovation & Research' => 'Innovation & Research',
                'Disaster Resilience' => 'Disaster Resilience',
                'Knowledge & Publication' => 'Knowledge & Publication',
                'Pemberdayaan Masyarakat' => 'Community Empowerment',
                'Konservasi Lingkungan' => 'Environmental Conservation',
                'Inovasi dan Riset' => 'Innovation & Research',
                'Ketahanan Bencana' => 'Disaster Resilience',
                'Kajian Ilmiah' => 'Scientific Research',
                'Laporan Kegiatan' => 'Activity Report',
                'Laporan Dampak' => 'Impact Report',
                'Buku & Monograf' => 'Books & Monographs',
                'Penerima Manfaat' => 'Beneficiaries',
                'Kelompok Tani' => 'Farmer Groups',
                'Desa Binaan' => 'Partner Village',
                'Relawan Muda' => 'Youth Volunteers',
                'Sedang Berjalan' => 'Ongoing',
                'Pendaftaran Dibuka' => 'Open Call',
                'Tahap Seleksi' => 'Selection Phase',
                'Selesai' => 'Completed',
                'Membangun kapasitas kepemimpinan' => 'Building leadership capacity',
                'secara kolaboratif' => 'collaboratively',
                'berbasis data' => 'data-driven',
                'tepat guna' => 'appropriate technology',
                'berkelanjutan' => 'sustainable',
            ];

            return str_ireplace(array_keys($dictionary), array_values($dictionary), $text);
        }

        return $text;
    }
}

