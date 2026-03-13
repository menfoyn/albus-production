<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPostSize
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch')) {
            $contentLength = $request->server('CONTENT_LENGTH', 0);
            $postMaxSize = $this->getPostMaxSizeInBytes();

            if ($postMaxSize > 0 && $contentLength > $postMaxSize) {
                return back()->with('error',
                    'Yüklemeye çalıştığınız dosyalar çok büyük (toplam ' . $this->formatBytes($contentLength) . '). ' .
                    'Sunucu limiti: ' . $this->formatBytes($postMaxSize) . '. ' .
                    'Lütfen daha küçük dosyalar deneyin veya tek tek yükleyin.'
                )->withInput();
            }

            // POST verisi boşsa ama content-length doluysa → PHP sessizce veriyi silmiş
            if ($contentLength > 0 && empty($request->all()) && empty($_FILES)) {
                return back()->with('error',
                    'Form verisi sunucu tarafından reddedildi. Dosyalar çok büyük olabilir. ' .
                    'Lütfen daha küçük dosyalar deneyin veya tek tek yükleyin.'
                )->withInput();
            }
        }

        return $next($request);
    }

    private function getPostMaxSizeInBytes(): int
    {
        $postMaxSize = ini_get('post_max_size');
        $value = (int) $postMaxSize;
        $unit = strtolower(substr($postMaxSize, -1));

        return match ($unit) {
            'g' => $value * 1024 * 1024 * 1024,
            'm' => $value * 1024 * 1024,
            'k' => $value * 1024,
            default => $value,
        };
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1024 * 1024 * 1024) {
            return round($bytes / (1024 * 1024 * 1024), 1) . ' GB';
        }
        if ($bytes >= 1024 * 1024) {
            return round($bytes / (1024 * 1024), 1) . ' MB';
        }
        return round($bytes / 1024, 1) . ' KB';
    }
}
