<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl italic text-charcoal">
            {{ __('Edit Document') }}
        </h2>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial">
            <form method="POST" action="{{ route('documents.update', $document) }}" enctype="multipart/form-data" class="max-w-2xl">
                @csrf
                @method('PUT')

                <div class="card-editorial">
                    <h3 class="font-serif text-xl italic text-charcoal mb-8">Document Details</h3>

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $document->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="document_type" :value="__('Document Type')" />
                            <select id="document_type" name="document_type" class="input-editorial mt-1 block w-full" required>
                                <option value="">Select type...</option>
                                <option value="national_id" {{ old('document_type', $document->document_type) == 'national_id' ? 'selected' : '' }}>National ID</option>
                                <option value="passport" {{ old('document_type', $document->document_type) == 'passport' ? 'selected' : '' }}>Passport</option>
                                <option value="drivers_license" {{ old('document_type', $document->document_type) == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                                <option value="visa" {{ old('document_type', $document->document_type) == 'visa' ? 'selected' : '' }}>Visa</option>
                                <option value="ticket" {{ old('document_type', $document->document_type) == 'ticket' ? 'selected' : '' }}>Ticket</option>
                                <option value="reservation" {{ old('document_type', $document->document_type) == 'reservation' ? 'selected' : '' }}>Reservation</option>
                                <option value="other" {{ old('document_type', $document->document_type) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('document_type')" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="input-editorial mt-1 block w-full">
                                <option value="">No category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="document_number" :value="__('Document Number')" />
                            <x-text-input id="document_number" name="document_number" type="text" class="mt-1 block w-full" :value="old('document_number', $document->document_number)" />
                            <x-input-error :messages="$errors->get('document_number')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="3" class="input-editorial mt-1 block w-full">{{ old('description', $document->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="issue_date" :value="__('Issue Date')" />
                                <x-text-input id="issue_date" name="issue_date" type="date" class="mt-1 block w-full" :value="old('issue_date', $document->issue_date?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('issue_date')" />
                            </div>

                            <div>
                                <x-input-label for="expiration_date" :value="__('Expiration Date')" />
                                <x-text-input id="expiration_date" name="expiration_date" type="date" class="mt-1 block w-full" :value="old('expiration_date', $document->expiration_date?->format('Y-m-d'))" />
                                <x-input-error :messages="$errors->get('expiration_date')" />
                            </div>
                        </div>

                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_favorite" value="1" {{ old('is_favorite', $document->is_favorite) ? 'checked' : '' }} class="border-charcoal/20 text-charcoal focus:ring-charcoal/50">
                                <span class="ms-2 text-xs text-muted">Mark as favorite</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-editorial mt-6">
                    <h3 class="font-serif text-xl italic text-charcoal mb-8">Upload Files</h3>

                    <div class="space-y-6">
                        @if($document->getMedia('document-images')->count() > 0)
                            <div class="mb-4">
                                <span class="label-editorial">Current Images</span>
                                <div class="flex gap-4 mt-2">
                                    @foreach($document->getMedia('document-images') as $media)
                                        <div class="w-24 h-24 border border-charcoal/10 overflow-hidden">
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="w-full h-full object-cover grayscale">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <x-input-label for="front_image" :value="__('Front Image')" />
                            <input type="file" id="front_image" name="front_image" accept="image/*" class="mt-1 block w-full text-xs text-muted file:mr-4 file:py-2 file:px-4 file:border file:border-charcoal/20 file:text-xs file:font-medium file:text-charcoal file:bg-transparent hover:file:bg-charcoal/5 file:uppercase file:tracking-[0.2em] file:transition-all file:duration-[500ms]">
                            <x-input-error :messages="$errors->get('front_image')" />
                        </div>

                        <div>
                            <x-input-label for="back_image" :value="__('Back Image')" />
                            <input type="file" id="back_image" name="back_image" accept="image/*" class="mt-1 block w-full text-xs text-muted file:mr-4 file:py-2 file:px-4 file:border file:border-charcoal/20 file:text-xs file:font-medium file:text-charcoal file:bg-transparent hover:file:bg-charcoal/5 file:uppercase file:tracking-[0.2em] file:transition-all file:duration-[500ms]">
                            <x-input-error :messages="$errors->get('back_image')" />
                        </div>

                        <div>
                            <x-input-label for="document_file" :value="__('Document File (PDF)')" />
                            <input type="file" id="document_file" name="document_file" accept=".pdf" class="mt-1 block w-full text-xs text-muted file:mr-4 file:py-2 file:px-4 file:border file:border-charcoal/20 file:text-xs file:font-medium file:text-charcoal file:bg-transparent hover:file:bg-charcoal/5 file:uppercase file:tracking-[0.2em] file:transition-all file:duration-[500ms]">
                            <x-input-error :messages="$errors->get('document_file')" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('documents.show', $document) }}" class="text-xs text-muted hover:text-charcoal transition-colors duration-[500ms] underline underline-offset-4 decoration-charcoal/30">
                        {{ __('Cancel') }}
                    </a>

                    <x-primary-button>
                        {{ __('Update Document') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>