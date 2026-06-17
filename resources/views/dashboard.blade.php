<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl italic text-charcoal">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-muted mb-2">Digital Wallet</p>
                    <h1 class="font-serif text-5xl md:text-6xl italic text-charcoal">Welcome, {{ Auth::user()->name }}</h1>
                </div>
                <a href="{{ route('documents.create') }}" class="btn-primary hidden md:inline-flex">
                    <span>{{ __('Add Document') }}</span>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                <div class="card-editorial">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Total</span>
                    <span class="font-serif text-4xl italic text-charcoal">{{ $stats['total'] }}</span>
                </div>
                <div class="card-editorial">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Favorites</span>
                    <span class="font-serif text-4xl italic text-charcoal">{{ $stats['favorites'] }}</span>
                </div>
                <div class="card-editorial">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Expiring Soon</span>
                    <span class="font-serif text-4xl italic {{ $stats['expiring_soon'] > 0 ? 'text-amber-600' : 'text-charcoal' }}">{{ $stats['expiring_soon'] }}</span>
                </div>
                <div class="card-editorial">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Categories</span>
                    <span class="font-serif text-4xl italic text-charcoal">{{ $stats['categories'] }}</span>
                </div>
            </div>

            @if($expiringDocuments->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="decorative-line"></div>
                        <span class="text-[10px] uppercase tracking-[0.3em] text-amber-600">Expiring Soon</span>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($expiringDocuments as $document)
                            <a href="{{ route('documents.show', $document) }}" class="card-editorial block group border-l-2 border-l-amber-600">
                                <span class="text-[10px] uppercase tracking-[0.3em] text-amber-600 block mb-2">
                                    Expires {{ $document->expiration_date->diffForHumans() }}
                                </span>
                                <h3 class="font-serif text-xl italic text-charcoal mb-1 group-hover:text-muted transition-colors duration-[500ms]">
                                    {{ $document->title }}
                                </h3>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-muted">
                                    {{ $document->expiration_date->format('M d, Y') }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($favoriteDocuments->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="decorative-line"></div>
                        <span class="text-[10px] uppercase tracking-[0.3em] text-muted">Favorites</span>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($favoriteDocuments as $document)
                            <a href="{{ route('documents.show', $document) }}" class="card-editorial block group">
                                <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">
                                    {{ str_replace('_', ' ', $document->document_type) }}
                                </span>
                                <h3 class="font-serif text-xl italic text-charcoal mb-1 group-hover:text-muted transition-colors duration-[500ms]">
                                    {{ $document->title }}
                                </h3>
                                @if($document->document_number)
                                    <span class="text-xs text-muted font-mono">{{ $document->document_number }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div class="decorative-line"></div>
                        <span class="text-[10px] uppercase tracking-[0.3em] text-muted">Recent Documents</span>
                    </div>
                    <a href="{{ route('documents.index') }}" class="text-xs text-muted hover:text-charcoal transition-colors duration-[500ms] uppercase tracking-[0.2em]">
                        View All &rarr;
                    </a>
                </div>

                @if($recentDocuments->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recentDocuments as $document)
                            <a href="{{ route('documents.show', $document) }}" class="card-editorial block group">
                                <div class="flex items-start justify-between mb-2">
                                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted">
                                        {{ str_replace('_', ' ', $document->document_type) }}
                                    </span>
                                    @if($document->is_favorite)
                                        <span class="text-charcoal">&#9733;</span>
                                    @endif
                                </div>
                                <h3 class="font-serif text-xl italic text-charcoal mb-1 group-hover:text-muted transition-colors duration-[500ms]">
                                    {{ $document->title }}
                                </h3>
                                @if($document->document_number)
                                    <span class="text-xs text-muted font-mono">{{ $document->document_number }}</span>
                                @endif
                                @if($document->category)
                                    <div class="mt-4 pt-4 border-t border-charcoal/10">
                                        <span class="text-[10px] uppercase tracking-[0.2em] text-muted">{{ $document->category->name }}</span>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="card-editorial text-center py-16">
                        <div class="font-serif text-4xl italic text-charcoal/10 mb-4">ID</div>
                        <p class="text-muted mb-8">No documents yet. Start by adding your first document.</p>
                        <a href="{{ route('documents.create') }}" class="btn-primary">
                            <span>{{ __('Add Your First Document') }}</span>
                        </a>
                    </div>
                @endif
            </div>

            @if($categories->count() > 0)
                <div class="mt-16">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="decorative-line"></div>
                        <span class="text-[10px] uppercase tracking-[0.3em] text-muted">Categories</span>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($categories as $category)
                            <a href="{{ route('documents.index', ['category_id' => $category->id]) }}" class="card-editorial block group">
                                <h3 class="font-serif text-lg italic text-charcoal mb-1 group-hover:text-muted transition-colors duration-[500ms]">
                                    {{ $category->name }}
                                </h3>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-muted">
                                    {{ $category->documents_count }} {{ Str::plural('document', $category->documents_count) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="md:hidden fixed bottom-0 left-0 right-0 p-4 bg-gallery/95 backdrop-blur-sm border-t border-charcoal/10">
        <a href="{{ route('documents.create') }}" class="btn-primary w-full text-center">
            <span>{{ __('Add Document') }}</span>
        </a>
    </div>
</x-app-layout>