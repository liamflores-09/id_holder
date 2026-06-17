<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('documents.index') }}" class="text-xs text-muted hover:text-charcoal transition-colors duration-[500ms] uppercase tracking-[0.2em]">
                &larr; {{ __('Back') }}
            </a>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('documents.toggle-favorite', $document) }}">
                    @csrf
                    <button type="submit" class="text-xs text-muted hover:text-charcoal transition-colors duration-[500ms] uppercase tracking-[0.2em]">
                        {{ $document->is_favorite ? '&#9733; Unfavorite' : '&#9734; Favorite' }}
                    </button>
                </form>
                <a href="{{ route('documents.edit', $document) }}" class="btn-secondary">
                    <span>{{ __('Edit') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial">
            <div class="grid lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <div class="card-editorial">
                        <div class="flex items-start justify-between mb-8">
                            <div>
                                <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">
                                    {{ str_replace('_', ' ', $document->document_type) }}
                                </span>
                                <h1 class="font-serif text-4xl md:text-5xl italic text-charcoal">
                                    {{ $document->title }}
                                </h1>
                            </div>
                            @if($document->is_favorite)
                                <span class="text-2xl text-charcoal">&#9733;</span>
                            @endif
                        </div>

                        @if($document->document_number)
                            <div class="mb-6">
                                <span class="label-editorial">Document Number</span>
                                <p class="text-charcoal font-mono">{{ $document->document_number }}</p>
                            </div>
                        @endif

                        @if($document->description)
                            <div class="mb-6">
                                <span class="label-editorial">Description</span>
                                <p class="text-muted leading-relaxed">{{ $document->description }}</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            @if($document->issue_date)
                                <div>
                                    <span class="label-editorial">Issue Date</span>
                                    <p class="text-charcoal">{{ $document->issue_date->format('M d, Y') }}</p>
                                </div>
                            @endif

                            @if($document->expiration_date)
                                <div>
                                    <span class="label-editorial">Expiration Date</span>
                                    <p class="text-charcoal {{ $document->expiration_date->isPast() ? 'text-red-600' : ($document->expiration_date->diffInDays(now()) <= 30 ? 'text-amber-600' : '') }}">
                                        {{ $document->expiration_date->format('M d, Y') }}
                                        @if($document->expiration_date->isPast())
                                            <span class="text-xs">(Expired)</span>
                                        @elseif($document->expiration_date->diffInDays(now()) <= 30)
                                            <span class="text-xs">(Expiring Soon)</span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if($document->category)
                            <div class="pt-6 border-t border-charcoal/10">
                                <span class="label-editorial">Category</span>
                                <p class="text-charcoal">{{ $document->category->name }}</p>
                            </div>
                        @endif
                    </div>

                    @if($document->getMedia('document-images')->count() > 0)
                        <div class="card-editorial mt-6">
                            <h3 class="font-serif text-xl italic text-charcoal mb-8">Document Images</h3>
                            <div class="grid md:grid-cols-2 gap-8">
                                @foreach($document->getMedia('document-images') as $media)
                                    <div class="image-card">
                                        <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="w-full grayscale hover:grayscale-0 transition-all duration-[1800ms]">
                                        <div class="p-4">
                                            <span class="text-[10px] uppercase tracking-[0.3em] text-muted">{{ $media->name }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-1">
                    <div class="card-editorial">
                        <h3 class="font-serif text-xl italic text-charcoal mb-8">Actions</h3>

                        <div class="space-y-4">
                            @if($document->getMedia('document-images')->count() > 0)
                                @foreach($document->getMedia('document-images') as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" class="btn-secondary block text-center">
                                        <span>View {{ $media->name }}</span>
                                    </a>
                                @endforeach
                            @endif

                            @if($document->getMedia('document-files')->count() > 0)
                                @foreach($document->getMedia('document-files') as $media)
                                    <a href="{{ $media->getUrl() }}" download class="btn-primary block text-center">
                                        <span>Download File</span>
                                    </a>
                                @endforeach
                            @endif

                            <form method="POST" action="{{ route('documents.toggle-archive', $document) }}">
                                @csrf
                                <button type="submit" class="btn-secondary w-full text-center">
                                    <span>{{ $document->is_archived ? 'Restore' : 'Archive' }}</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('documents.destroy', $document) }}" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 text-xs font-medium uppercase tracking-[0.2em] text-red-600 hover:text-red-700 transition-colors duration-[500ms]">
                                    Delete Document
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-editorial mt-6">
                        <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Created</span>
                        <p class="text-charcoal text-sm">{{ $document->created_at->format('M d, Y') }}</p>

                        <div class="mt-4">
                            <span class="text-[10px] uppercase tracking-[0.3em] text-muted block mb-2">Last Updated</span>
                            <p class="text-charcoal text-sm">{{ $document->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>