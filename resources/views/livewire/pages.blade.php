<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Page') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.500ms="title" />
                @error('title') @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        http://localhost:8000/
                    </span>
                    <x-jet-input id="title" 
                        class="block mt-1 w-full  form-input flex-1 rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" 
                        style="border-top-left-radius: none !important; border-bottom-left-radius: none !important;" 
                        placeholder="url-slug" type="text" 
                        wire:model.debounce.500ms="slug" />
                </div>
            </div>
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor 
                                class="trix-content"
                                x-ref="trix" 
                                wire:model.debounce.100000ms="content"
                                wire:key="trix-content-unique-key"
                                ></trix-editor>
                        </div>
                    </div>
                </div>
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="create()" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
