<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::where('user_id', Auth::id())->active()->with('category');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('document_number', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('document_type')) {
            $query->where('document_type', $request->document_type);
        }

        if ($request->boolean('favorites_only')) {
            $query->favorite();
        }

        $documents = $query->latest()->paginate(12);
        $categories = Category::where('user_id', Auth::id())->orderBy('sort_order')->get();

        return view('documents.index', compact('documents', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('sort_order')->get();

        return view('documents.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'document_type' => 'required|string|in:national_id,passport,drivers_license,visa,ticket,reservation,other',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after:issue_date',
            'is_favorite' => 'boolean',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'document_file' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
        ]);

        $document = Document::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'document_type' => $validated['document_type'],
            'document_number' => $validated['document_number'] ?? null,
            'issue_date' => $validated['issue_date'] ?? null,
            'expiration_date' => $validated['expiration_date'] ?? null,
            'is_favorite' => $validated['is_favorite'] ?? false,
        ]);

        if ($request->hasFile('front_image')) {
            $document->addMediaFromRequest('front_image')->usingName('front')->toMediaCollection('document-images');
        }

        if ($request->hasFile('back_image')) {
            $document->addMediaFromRequest('back_image')->usingName('back')->toMediaCollection('document-images');
        }

        if ($request->hasFile('document_file')) {
            $document->addMediaFromRequest('document_file')->usingName('document')->toMediaCollection('document-files');
        }

        return redirect()->route('documents.show', $document)->with('success', 'Document created successfully.');
    }

    public function show(Document $document)
    {
        $this->authorize('view', $document);

        $document->load('category', 'media');

        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $this->authorize('update', $document);

        $categories = Category::where('user_id', Auth::id())->orderBy('sort_order')->get();
        $document->load('media');

        return view('documents.edit', compact('document', 'categories'));
    }

    public function update(Request $request, Document $document)
    {
        $this->authorize('update', $document);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'document_type' => 'required|string|in:national_id,passport,drivers_license,visa,ticket,reservation,other',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after:issue_date',
            'is_favorite' => 'boolean',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'document_file' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
        ]);

        $document->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'document_type' => $validated['document_type'],
            'document_number' => $validated['document_number'] ?? null,
            'issue_date' => $validated['issue_date'] ?? null,
            'expiration_date' => $validated['expiration_date'] ?? null,
            'is_favorite' => $validated['is_favorite'] ?? false,
        ]);

        if ($request->hasFile('front_image')) {
            $document->clearMediaCollection('document-images');
            $document->addMediaFromRequest('front_image')->usingName('front')->toMediaCollection('document-images');
        }

        if ($request->hasFile('back_image')) {
            $document->addMediaFromRequest('back_image')->usingName('back')->toMediaCollection('document-images');
        }

        if ($request->hasFile('document_file')) {
            $document->clearMediaCollection('document-files');
            $document->addMediaFromRequest('document_file')->usingName('document')->toMediaCollection('document-files');
        }

        return redirect()->route('documents.show', $document)->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        $document->clearAllMediaCollections();
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }

    public function toggleFavorite(Document $document)
    {
        $this->authorize('update', $document);

        $document->update(['is_favorite' => !$document->is_favorite]);

        return back()->with('success', $document->is_favorite ? 'Added to favorites.' : 'Removed from favorites.');
    }

    public function toggleArchive(Document $document)
    {
        $this->authorize('update', $document);

        $document->update(['is_archived' => !$document->is_archived]);

        return back()->with('success', $document->is_archived ? 'Document archived.' : 'Document restored.');
    }
}