<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(): View
    {
        $page = Page::where('slug', 'descargas')
            ->where('status', true)
            ->firstOrFail();

        $sections = $page->sections()
            ->where('status', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $downloads = Download::where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('pages.descargas', compact('page', 'sections', 'downloads'));
    }

    public function file(Download $download): StreamedResponse
    {
        abort_unless($download->status, 404);
        abort_unless(Storage::disk('public')->exists($download->file_path), 404);

        return Storage::disk('public')->download(
            $download->file_path,
            $this->downloadName($download)
        );
    }

    private function downloadName(Download $download): string
    {
        $extension = strtolower(pathinfo($download->file_path, PATHINFO_EXTENSION));
        // The original upload name is not stored; use the public document title.
        $name = preg_replace('/[\x00-\x1F\x7F<>:"\/\\\\|?*]+/u', ' ', (string) $download->title);
        $name = trim(preg_replace('/\s+/u', ' ', $name), " .\t\n\r\0\x0B");
        if ($extension !== '' && str_ends_with(strtolower($name), '.'.$extension)) {
            $name = substr($name, 0, -strlen($extension) - 1);
        }
        $name = rtrim(mb_substr($name, 0, 150), ' .');
        if ($name === '') {
            $name = 'Documento-'.($download->id ?? 'descarga');
        }
        if (preg_match('/^(CON|PRN|AUX|NUL|COM[1-9]|LPT[1-9])(?:\.|$)/i', $name)) {
            $name = 'Documento-'.$name;
        }

        return $name.($extension !== '' ? '.'.$extension : '');
    }
}
