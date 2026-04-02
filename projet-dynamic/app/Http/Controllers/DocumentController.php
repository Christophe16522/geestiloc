<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Models\Property;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function __construct(private DocumentService $service) {}

    public function index(Request $request): View
    {
        return view('documents.index', [
            'documents' => $this->service->getFiltered($request),
        ]);
    }

    public function create(): View
    {
        $properties = Property::where('user_id', auth()->id())->get();

        return view('documents.create', compact('properties'));
    }

    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        $this->service->store($request->validated(), $request->file('file'));

        return redirect()->route('documents.index')->with('success', 'Document uploadé avec succès.');
    }

    public function show(Document $document): View
    {
        $this->authorize('view', $document);

        return view('documents.show', compact('document'));
    }

    public function destroy(Document $document): RedirectResponse
    {
        $this->authorize('delete', $document);
        $this->service->destroy($document);

        return redirect()->route('documents.index')->with('success', 'Document supprimé.');
    }
}
