<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse" wire:loading>
        <x-tmk.preloader class="bg-lime-700/60 text-white border border-lime-700 shadow-2xl">
            {{$loading}}
        </x-tmk.preloader>
    </div>

    <div class="my-4">{{$records->links()}}</div>
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">
        @foreach($records as $record)
        <div
            wire:key="record-{{$record->id}}"
            class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <img class="w-52 h-52 border-r border-gray-300 object-cover"
                 src="{{ $record->cover }}"
                 alt="{{$record ->title}}"
                 title="{{$record->title}}">
            <div class="flex-1 flex flex-col">
                <div class="flex-1 p-4">
                    <p class="text-lg font-medium">{{$record->artist}}</p>
                    <p class="italic pb-2">{{$record->title}}</p>
                    <p class="italic font-thin text-right pt-2 mb-2">{{$record->genre_name}}</p>
                </div>
                <div class="flex justify-between border-t border-gray-300 bg-gray-100 px-4 py-2">
                    <div>{{$record->price_euro}}</div>
                    <div class="flex space-x-4">
                        @if($record->stock>0)
                        <button class="w-6 hover:text-red-900" data-tippy-content="Add to dasket<br><span class='text-red-300'>NOT IMPLEMENTED YET</span>">
                            <x-phosphor-shopping-bag-light class="outline-0"/>
                        </button>
                        @else
                            <p class="font-extrabold text-red-700">SOLD OUT</p>
                        @endif
                        <button class="w-6 hover:text-red-900" >
                            <x-phosphor-music-notes-light
                                wire:click="showTracks({{$record->id}})"
                                class="outline-0" data-tippy-content="Show tracks"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="my-4">{{$records->links()}}</div>
    {{-- Detail section --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            <div class="flex items-center border-b border-gray-300 pb-2 gap-4">
                <img class="w-20 h-20" src="{{$selectedRecord->cover ?? asset('storage/covers/no-cover.png')}}" alt="">
                <h3 class="font-medium">
                    {{$selectedRecord->title ?? ''}}<br/>
                    <span class="font-light">{{$selectedRecord->artist ?? ''}}</span>
                </h3>
            </div>
        </x-slot>
        <x-slot name="content">
            @isset($selectedRecord->tracks)
                <table class="w-full text-left align-top">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Track</th>
                        <th class="px-4 py-2">Length</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selectedRecord['tracks'] as $track)
                        <tr class="border-t border-gray-100">
                            <td class="px-4 py-2">{{$track['position']}}</td>
                            <td class="px-4 py-2">{{$track['title']}}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::createFromTimestampMs($track['length'])->format('i:s')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endisset
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
    <x-tmk.livewire-log/>
</div>
