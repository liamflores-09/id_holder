<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('documents.index') }}" class="editorial-link" style="letter-spacing: normal;">
                &larr; {{ __('Back') }}
            </a>
            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="{{ route('documents.toggle-favorite', $document) }}">
                    @csrf
                    <button type="submit" class="editorial-link border-0 bg-transparent p-0" style="letter-spacing: normal;">
                        {{ $document->is_favorite ? '&#9733; Unfavorite' : '&#9734; Favorite' }}
                    </button>
                </form>
                <a href="{{ route('documents.edit', $document) }}" class="btn-editorial-outline"><span>{{ __('Edit') }}</span></a>
            </div>
        </div>
    </x-slot>

    <div class="editorial-section">
        <div class="container-xl px-4 px-md-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="editorial-card">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <span class="editorial-text d-block mb-2">{{ str_replace('_', ' ', $document->document_type) }}</span>
                                <h1 class="font-serif" style="font-size: 2.5rem; font-style: italic;">{{ $document->title }}</h1>
                            </div>
                            @if($document->is_favorite)
                                <span style="font-size: 1.5rem; color: var(--charcoal);">&#9733;</span>
                            @endif
                        </div>

                        @if($document->document_number)
                            <div class="mb-3">
                                <span class="editorial-label">Document Number</span>
                                <p style="font-family: monospace;">{{ $document->document_number }}</p>
                            </div>
                        @endif

                        @if($document->description)
                            <div class="mb-3">
                                <span class="editorial-label">Description</span>
                                <p style="color: var(--muted); line-height: 1.6;">{{ $document->description }}</p>
                            </div>
                        @endif

                        <div class="row g-3 mb-3">
                            @if($document->issue_date)
                                <div class="col-6">
                                    <span class="editorial-label">Issue Date</span>
                                    <p>{{ $document->issue_date->format('M d, Y') }}</p>
                                </div>
                            @endif
                            @if($document->expiration_date)
                                <div class="col-6">
                                    <span class="editorial-label">Expiration Date</span>
                                    <p style="{{ $document->expiration_date->isPast() ? 'color: #dc3545;' : ($document->expiration_date->diffInDays(now()) <= 30 ? 'color: #d97706;' : '') }}">
                                        {{ $document->expiration_date->format('M d, Y') }}
                                        @if($document->expiration_date->isPast())
                                            <span style="font-size: 0.75rem;">(Expired)</span>
                                        @elseif($document->expiration_date->diffInDays(now()) <= 30)
                                            <span style="font-size: 0.75rem;">(Expiring Soon)</span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if($document->category)
                            <div class="pt-3" style="border-top: 1px solid var(--border);">
                                <span class="editorial-label">Category</span>
                                <p>{{ $document->category->name }}</p>
                            </div>
                        @endif
                    </div>

                    @if($document->getMedia('document-images')->count() > 0)
                        <div class="editorial-card mt-3">
                            <h3 class="font-serif mb-4" style="font-size: 1.25rem; font-style: italic;">Document Images</h3>
                            <div class="row g-4">
                                @foreach($document->getMedia('document-images') as $media)
                                    <div class="col-md-6">
                                        <div class="image-card">
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="w-100 image-editorial">
                                            <div class="p-3">
                                                <span class="editorial-text">{{ $media->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="editorial-card">
                        <h3 class="font-serif mb-4" style="font-size: 1.25rem; font-style: italic;">Actions</h3>

                        <div class="d-grid gap-2">
                            @if($document->getMedia('document-images')->count() > 0)
                                @foreach($document->getMedia('document-images') as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" class="btn-editorial-outline text-center text-decoration-none">
                                        View {{ $media->name }}
                                    </a>
                                @endforeach
                            @endif

                            @if($document->getMedia('document-files')->count() > 0)
                                @foreach($document->getMedia('document-files') as $media)
                                    <a href="{{ $media->getUrl() }}" download class="btn-editorial text-center text-decoration-none">
                                        <span>Download File</span>
                                    </a>
                                @endforeach
                            @endif

                            <form method="POST" action="{{ route('documents.toggle-archive', $document) }}">
                                @csrf
                                <button type="submit" class="btn-editorial-outline w-100">
                                    {{ $document->is_archived ? 'Restore' : 'Archive' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('documents.destroy', $document) }}" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-editorial-outline w-100" style="border-color: #dc3545; color: #dc3545;">
                                    Delete Document
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="editorial-card mt-3">
                        <span class="editorial-label d-block mb-1">Created</span>
                        <p style="font-size: 0.875rem;">{{ $document->created_at->format('M d, Y') }}</p>

                        <div class="mt-3">
                            <span class="editorial-label d-block mb-1">Last Updated</span>
                            <p style="font-size: 0.875rem;">{{ $document->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>