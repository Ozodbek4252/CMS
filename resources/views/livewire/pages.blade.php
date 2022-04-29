<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>


    {{-- The data table --}}
    


    <table class="w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($data->count())
                @foreach($data as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $item->slug }}</td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! $item-> content !!}</td>
                        <td class="px-6 py-4 text-right text-sm">
                            <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                {{ __('Update') }}
                            </x-jet-button>
                            <x-jet-danger-button wire:click="createShowModal">
                                {{ __('Delete') }}
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
                    </tr>
            @endif
        </tbody>
    </table>

    {{ $data->links() }}

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Page') }} {{ $modelId }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.500ms="title" />
                @error('title') <span class="error">{{$message}}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        http://localhost:8000/
                    </span>
                    <x-jet-input id="slug" 
                        class="block mt-1 w-full  form-input flex-1 rounded-none transition duration-150 ease-in-out sm:text-sm sm:leading-5" 
                        style="border-top-left-radius: none !important; border-bottom-left-radius: none !important;" 
                        placeholder="url-slug" type="text" 
                        wire:model.debounce.500ms="slug" />
                </div>
                @error('slug') <span class="error">{{$message}}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="content" value="{{ __('Content') }}" />
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
                @error('content') <span class="error">{{$message}}</span> @enderror
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if($modelId)
                <x-jet-button class="ml-3" wire:click="update()" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-3" wire:click="create()" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif

            
        </x-slot>
    </x-jet-dialog-modal>
</div>
