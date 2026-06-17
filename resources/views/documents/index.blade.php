<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-3xl italic text-charcoal">
                {{ __('Documents') }}
            </h2>
            <a href="{{ route('documents.create') }}" class="btn-primary">
                <span>{{ __('Add Document') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial">
            <form method="GET" action="{{ route('documents.index') }}" class="mb-12">
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents..." class="input-editorial flex-1">
                    <select name="category_id" class="input-editorial w-full md:w-48">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ $category->documents_count }})
                            </option>
                        @endforeach
                    </select>
                    <select name="document_type" class="input-editorial w-full md:w-48">
                        <option value="">All Types</option>
                        <option value="national_id" {{ request('document_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                        <option value="passport" {{ request('document_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                        <option value="drivers_license" {{ request('document_type') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                        <option value="visa" {{ request('document_type') == 'visa' ? 'selected' : '' }}>Visa</option>
                        <option value="ticket" {{ request('document_type') == 'ticket' ? 'selected' : '' }}>Ticket</option>
                        <option value="reservation" {{ request('document_type') == 'reservation' ? 'selected' : '' }}>Reservation</option>
                        <option value="other" {{ request('document_type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <button type="submit" class="btn-secondary">
                        <span>{{ __('Filter') }}</span>
                    </button>
                </div>
            </form>

            @if($documents->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($documents as $document)
                        <a href="{{ route('documents.show', $document) }}" class="card-editorial block group">
                            <div class="flex items-start justify-between mb-4">
                                <span class="text-[10px] uppercase tracking-[0.3em] text-muted">
                                    {{ str_replace('_', ' ', $document->document_type) }}
                                </span>
                                @if($document->is_favorite)
                                    <span class="text-charcoal">&#9733;</span>
                                @endif
                            </div>

                            <h3 class="font-serif text-xl italic text-charcoal mb-2 group-hover:text-muted transition-colors duration-[500ms]">
                                {{ $document->title }}
                            </h3>

                            @if($document->document_number)
                                <p class="text-xs text-muted mb-4 font-mono">
                                    {{ $document->document_number }}
                                </p>
                            @endif

                            @if($document->expiration_date)
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] uppercase tracking-[0.2em] {{ $document->expiration_date->isPast() ? 'text-red-600' : ($document->expiration_date->diffInDays(now()) <= 30 ? 'text-amber-600' : 'text-muted') }}">
                                        {{ $document->expiration_date->isPast() ? 'Expired' : 'Expires' }} {{ $document->expiration_date->format('M d, Y') }}
                                    </span>
                                </div>
                            @endif

                            @if($document->category)
                                <div class="mt-4 pt-4 border-t border-charcoal/10">
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-muted">
                                        {{ $document->category->name }}
                                    </span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $documents->withQueryString()->links() }}
                </div>
            @else
                <div class="card-editorial text-center py-16">
                    <div class="font-serif text-4xl italic text-charcoal/10 mb-4">ID</div>
                    <p class="text-muted mb-8">No documents found.</p>
                    <a href="{{ route('documents.create') }}" class="btn-primary">
                        <span>{{ __('Add Your First Document') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>