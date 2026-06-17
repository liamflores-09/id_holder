<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif" style="font-size: 1.875rem; font-style: italic;">{{ __('Add Document') }}</h2>
    </x-slot>

    <div class="editorial-section">
        <div class="container-xl px-4 px-md-5">
            <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" style="max-width: 640px;">
                @csrf

                <div class="editorial-card">
                    <h3 class="font-serif mb-4" style="font-size: 1.25rem; font-style: italic;">Document Details</h3>

                    <div class="mb-3">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="d-block w-100" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="document_type" :value="__('Document Type')" />
                        <select id="document_type" name="document_type" class="editorial-input" required>
                            <option value="">Select type...</option>
                            <option value="national_id" {{ old('document_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                            <option value="passport" {{ old('document_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                            <option value="drivers_license" {{ old('document_type') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                            <option value="visa" {{ old('document_type') == 'visa' ? 'selected' : '' }}>Visa</option>
                            <option value="ticket" {{ old('document_type') == 'ticket' ? 'selected' : '' }}>Ticket</option>
                            <option value="reservation" {{ old('document_type') == 'reservation' ? 'selected' : '' }}>Reservation</option>
                            <option value="other" {{ old('document_type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('document_type')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="editorial-input">
                            <option value="">No category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="document_number" :value="__('Document Number')" />
                        <x-text-input id="document_number" name="document_number" type="text" class="d-block w-100" :value="old('document_number')" />
                        <x-input-error :messages="$errors->get('document_number')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="3" class="editorial-input">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" />
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <x-input-label for="issue_date" :value="__('Issue Date')" />
                            <x-text-input id="issue_date" name="issue_date" type="date" class="d-block w-100" :value="old('issue_date')" />
                            <x-input-error :messages="$errors->get('issue_date')" />
                        </div>
                        <div class="col-6">
                            <x-input-label for="expiration_date" :value="__('Expiration Date')" />
                            <x-text-input id="expiration_date" name="expiration_date" type="date" class="d-block w-100" :value="old('expiration_date')" />
                            <x-input-error :messages="$errors->get('expiration_date')" />
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_favorite" value="1" {{ old('is_favorite') ? 'checked' : '' }} class="form-check-input editorial-checkbox" id="is_favorite">
                        <label class="form-check-label editorial-text" for="is_favorite" style="text-transform: none; letter-spacing: normal;">Mark as favorite</label>
                    </div>
                </div>

                <div class="editorial-card mt-3">
                    <h3 class="font-serif mb-4" style="font-size: 1.25rem; font-style: italic;">Upload Files</h3>

                    <div class="mb-3">
                        <x-input-label for="front_image" :value="__('Front Image')" />
                        <input type="file" id="front_image" name="front_image" accept="image/*" class="editorial-input file-input-editorial">
                        <x-input-error :messages="$errors->get('front_image')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="back_image" :value="__('Back Image')" />
                        <input type="file" id="back_image" name="back_image" accept="image/*" class="editorial-input file-input-editorial">
                        <x-input-error :messages="$errors->get('back_image')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="document_file" :value="__('Document File (PDF)')" />
                        <input type="file" id="document_file" name="document_file" accept=".pdf" class="editorial-input file-input-editorial">
                        <x-input-error :messages="$errors->get('document_file')" />
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('documents.index') }}" class="editorial-link text-decoration-underline" style="letter-spacing: normal;">
                        {{ __('Cancel') }}
                    </a>

                    <x-primary-button>{{ __('Save Document') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>