<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif" style="font-size: 1.875rem; font-style: italic;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="editorial-section">
        <div class="container-xl px-4 px-md-5">
            <div class="mb-5">
                <p class="editorial-text mb-2">Digital Wallet</p>
                <h1 class="font-serif" style="font-size: 2.5rem; font-style: italic;">Welcome, {{ Auth::user()->name }}</h1>
            </div>

            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="editorial-text mb-1">Total</div>
                        <div class="stat-number">{{ $stats['total'] }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="editorial-text mb-1">Favorites</div>
                        <div class="stat-number">{{ $stats['favorites'] }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="editorial-text mb-1">Expiring Soon</div>
                        <div class="stat-number" style="{{ $stats['expiring_soon'] > 0 ? 'color: #d97706;' : '' }}">{{ $stats['expiring_soon'] }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="editorial-text mb-1">Categories</div>
                        <div class="stat-number">{{ $stats['categories'] }}</div>
                    </div>
                </div>
            </div>

            @if($expiringDocuments->count() > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="editorial-divider"></div>
                        <span class="editorial-text" style="color: #d97706;">Expiring Soon</span>
                    </div>
                    <div class="row g-4">
                        @foreach($expiringDocuments as $document)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">
                                    <div class="editorial-card" style="border-left: 2px solid #d97706;">
                                        <div class="editorial-text mb-2" style="color: #d97706;">
                                            Expires {{ $document->expiration_date->diffForHumans() }}
                                        </div>
                                        <h3 class="font-serif mb-1" style="font-size: 1.25rem; font-style: italic; color: var(--charcoal);">
                                            {{ $document->title }}
                                        </h3>
                                        <span class="editorial-text">
                                            {{ $document->expiration_date->format('M d, Y') }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($favoriteDocuments->count() > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="editorial-divider"></div>
                        <span class="editorial-text">Favorites</span>
                    </div>
                    <div class="row g-4">
                        @foreach($favoriteDocuments as $document)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">
                                    <div class="editorial-card">
                                        <div class="editorial-text mb-2">{{ str_replace('_', ' ', $document->document_type) }}</div>
                                        <h3 class="font-serif mb-1" style="font-size: 1.25rem; font-style: italic; color: var(--charcoal);">
                                            {{ $document->title }}
                                        </h3>
                                        @if($document->document_number)
                                            <span style="font-size: 0.75rem; color: var(--muted); font-family: monospace;">{{ $document->document_number }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="editorial-divider"></div>
                        <span class="editorial-text">Recent Documents</span>
                    </div>
                    <a href="{{ route('documents.index') }}" class="editorial-link">View All &rarr;</a>
                </div>

                @if($recentDocuments->count() > 0)
                    <div class="row g-4">
                        @foreach($recentDocuments as $document)
                            <div class="col-md-6 col-lg-4">
                                <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">
                                    <div class="editorial-card">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="editorial-text">{{ str_replace('_', ' ', $document->document_type) }}</span>
                                            @if($document->is_favorite)
                                                <span style="color: var(--charcoal);">&#9733;</span>
                                            @endif
                                        </div>
                                        <h3 class="font-serif mb-1" style="font-size: 1.25rem; font-style: italic; color: var(--charcoal);">
                                            {{ $document->title }}
                                        </h3>
                                        @if($document->document_number)
                                            <span style="font-size: 0.75rem; color: var(--muted); font-family: monospace;">{{ $document->document_number }}</span>
                                        @endif
                                        @if($document->category)
                                            <div class="mt-3 pt-3" style="border-top: 1px solid var(--border);">
                                                <span class="editorial-text">{{ $document->category->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="editorial-card text-center py-5">
                        <div class="font-serif mb-3" style="font-size: 2.5rem; font-style: italic; color: rgba(17,17,17,0.1);">ID</div>
                        <p style="color: var(--muted);" class="mb-4">No documents yet. Start by adding your first document.</p>
                        <a href="{{ route('documents.create') }}" class="btn-editorial"><span>{{ __('Add Your First Document') }}</span></a>
                    </div>
                @endif
            </div>

            @if($categories->count() > 0)
                <div class="mt-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="editorial-divider"></div>
                        <span class="editorial-text">Categories</span>
                    </div>
                    <div class="row g-4">
                        @foreach($categories as $category)
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('documents.index', ['category_id' => $category->id]) }}" class="text-decoration-none">
                                    <div class="editorial-card">
                                        <h3 class="font-serif mb-1" style="font-size: 1.125rem; font-style: italic; color: var(--charcoal);">
                                            {{ $category->name }}
                                        </h3>
                                        <span class="editorial-text">{{ $category->documents_count }} {{ Str::plural('document', $category->documents_count) }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>