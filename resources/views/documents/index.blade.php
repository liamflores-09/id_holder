<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-serif" style="font-size: 1.875rem; font-style: italic;">{{ __('Documents') }}</h2>
            <a href="{{ route('documents.create') }}" class="btn-editorial"><span>{{ __('Add Document') }}</span></a>
        </div>
    </x-slot>

    <div class="editorial-section">
        <div class="container-xl px-4 px-md-5">
            <form method="GET" action="{{ route('documents.index') }}" class="mb-5">
                <div class="row g-3">
                    <div class="col-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search documents..." class="editorial-input w-100">
                    </div>
                    <div class="col-md-auto">
                        <select name="category_id" class="editorial-input">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->documents_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select name="document_type" class="editorial-input">
                            <option value="">All Types</option>
                            <option value="national_id" {{ request('document_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                            <option value="passport" {{ request('document_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                            <option value="drivers_license" {{ request('document_type') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                            <option value="visa" {{ request('document_type') == 'visa' ? 'selected' : '' }}>Visa</option>
                            <option value="ticket" {{ request('document_type') == 'ticket' ? 'selected' : '' }}>Ticket</option>
                            <option value="reservation" {{ request('document_type') == 'reservation' ? 'selected' : '' }}>Reservation</option>
                            <option value="other" {{ request('document_type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn-editorial-outline"><span>{{ __('Filter') }}</span></button>
                    </div>
                </div>
            </form>

            @if($documents->count() > 0)
                <div class="row g-4">
                    @foreach($documents as $document)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">
                                <div class="editorial-card">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="editorial-text">{{ str_replace('_', ' ', $document->document_type) }}</span>
                                        @if($document->is_favorite)
                                            <span style="color: var(--charcoal);">&#9733;</span>
                                        @endif
                                    </div>

                                    <h3 class="font-serif mb-2" style="font-size: 1.25rem; font-style: italic; color: var(--charcoal);">
                                        {{ $document->title }}
                                    </h3>

                                    @if($document->document_number)
                                        <p style="font-size: 0.75rem; color: var(--muted); font-family: monospace;" class="mb-3">
                                            {{ $document->document_number }}
                                        </p>
                                    @endif

                                    @if($document->expiration_date)
                                        <div>
                                            <span style="font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.2em; {{ $document->expiration_date->isPast() ? 'color: #dc3545;' : ($document->expiration_date->diffInDays(now()) <= 30 ? 'color: #d97706;' : 'color: var(--muted);') }}">
                                                {{ $document->expiration_date->isPast() ? 'Expired' : 'Expires' }} {{ $document->expiration_date->format('M d, Y') }}
                                            </span>
                                        </div>
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

                <div class="mt-5">
                    {{ $documents->withQueryString()->links() }}
                </div>
            @else
                <div class="editorial-card text-center py-5">
                    <div class="font-serif mb-3" style="font-size: 2.5rem; font-style: italic; color: rgba(17,17,17,0.1);">ID</div>
                    <p style="color: var(--muted);" class="mb-4">No documents found.</p>
                    <a href="{{ route('documents.create') }}" class="btn-editorial"><span>{{ __('Add Your First Document') }}</span></a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>