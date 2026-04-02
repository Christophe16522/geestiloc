<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function store(array $data, UploadedFile $file): Document
    {
        $path = $file->store('documents', 'local');

        return Document::create(array_merge($data, [
            'user_id'     => Auth::id(),
            'file_path'   => $path,
            'file_size'   => $file->getSize(),
            'mime_type'   => $file->getMimeType(),
            'upload_date' => now(),
        ]));
    }

    public function destroy(Document $document): bool
    {
        Storage::disk('local')->delete($document->file_path);
        return $document->delete();
    }

    public function getExpiring(int $days = 30): Collection
    {
        return Document::where('user_id', Auth::id())->expiringSoon($days)->with('property')->get();
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Document::where('user_id', Auth::id())->with('property');

        if ($category = $request->get('category')) {
            $query->byCategory($category);
        }

        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->latest()->paginate(15)->withQueryString();
    }
}
