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
            basename($download->file_path)
        );
    }
}
