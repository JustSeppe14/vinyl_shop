<div>
    {{-- Filter --}}
    <x-tmk.section class="mb-4 flex gap-2">
        <div class="flex-1">
            <x-input id="search" type="text" placeholder="Filter Artist Or Record"
                     wire:model.live.debounce.500ms="search"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
        <x-tmk.form.switch id="noStock"
                           wire:model.live="noStock"
                           text-off="No stock"
                           color-off="bg-gray-100 before:line-through"
                           text-on="No stock"
                           color-on="text-white bg-lime-600"
                           class="w-20 h-auto" />
        <x-tmk.form.switch id="noCover"
                           wire:model.live="noCover"
                           text-off="Records without cover"
                           color-off="bg-gray-100 before:line-through"
                           text-on="Records without cover"
                           color-on="text-white bg-lime-600"
                           class="w-44 h-auto" />
        <x-button wire:click="newRecord()">
            new record
        </x-button>
    </x-tmk.section>

    {{-- Table with records --}}
    <x-tmk.section>
        <div class="my-4">{{ $records->links() }}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-14">
                <col class="w-20">
                <col class="w-20">
                <col class="w-14">
                <col class="w-max">
                <col class="w-24">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>#</th>
                <th></th>
                <th>Price</th>
                <th>Stock</th>
                <th class="text-left">Record</th>
                <th>
                    <x-tmk.form.select id="perPage"
                                       wire:model.live="perPage"
                                       class="block mt-1 w-full">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </x-tmk.form.select>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($records as $record)
                <tr
                    wire:key="{{$record->id}}"
                    class="border-t border-gray-300">
                    <td>{{ $record->id }}</td>
                    <td>
                        <img src="{{ $record->cover }}"
                             alt="{{ $record->title }} by {{ $record->artist }}"
                             class="my-2 border object-cover">
                    </td>
                    <td>{{ $record->price_euro }}</td>
                    <td>{{ $record->stock }}</td>
                    <td class="text-left">
                        <p class="text-lg font-medium">{{ $record->artist }}</p>
                        <p class="italic">{{ $record->title }}</p>
                        <p class="text-sm text-teal-700">{{ $record->genre_name }}</p>
                    </td>
                    <td>
                        <div class="border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10">
                            <button
                                wire:click="editRecord({{$record->id}})"
                                class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                                <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                            </button>
                            <button
                                class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                                <x-phosphor-trash-duotone class="inline-block w-5 h-5"/>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <div class="font-bold italic text-sky-800">No records found</div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="my-4">{{ $records->links() }}</div>
    </x-tmk.section>

    {{-- Modal for add and update record --}}
    <x-dialog-modal id="recordModal"
                    wire:model.live="showModal">
        <x-slot name="title">
            <h2>New record</h2>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-label for="id" value="MusicBrainz id"/>
                    <x-input type="text" id="id" name="Musicbrainzid"
                             wire:model.live="form.mb_id"
                             placeholder="MusicBrainz ID" />
                    <x-button for="id" wire:click="getDataFromMusicbrainzApi()"
                              class="w-1/4">Get record info</x-button>
                    <x-input-error for="id" class="mt-2"/>
                </div>
                <div class="col-span-2">
                    <x-label for="genre" value="Genre"/>
                    <x-tmk.form.select id="Genre"
                                       wire:model.live="genre"
                                       class="block mt-1 w-2/3">
                        <option value="%">Select a genre</option>
                        @foreach($genres as $g)
                            <option value="{{$g->id}}">
                                {{$g->name}}
                            </option>
                        @endforeach
                    </x-tmk.form.select>
                    <x-input-error for="genre" class="mt-2"/>
                </div>
                <div class="col-span-2">
                    <x-label for="price" value="Price"/>
                    <x-input type="number" id="price"
                             wire:model.live="form.price"/>
                    <x-input-error for="price" class="mt-2"/>
                </div>
                <div class="col-span-2">
                    <x-label for="stock" value="Stock"/>
                    <x-input type="number" id="stock"
                             wire:model.live="form.stock"/>
                    <x-input-error for="stock" class="mt-2"/>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false">Cancel</x-secondary-button>
            <x-button wire:model="form"
                      wire:click="newRecord()"
                      >Save you record</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
