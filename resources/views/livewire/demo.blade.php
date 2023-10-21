<div>
    <h2>Genres with records</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($genres as $genre)
            <div class="flex space-x-4 bg-white shadow-md rounded-lg p-4">
                <div class="flex-none w-36 border-r border-gray-200">
                    <h3 class="font-bold text-xl">{{ $genre->name }}</h3>
                    <p>Has {{ $genre->records()->count() }} {{ Str::plural('record', $genre->records()->count()) }}</p>
                </div>
                <div>
                    @foreach($genre->records as $record)
                        <x-tmk.list class="list-outside ml-4">
                            <li>
                                <span class="font-bold">{{ $record->artist }}</span><br>
                                {{ $record->title }}
                            </li>
                        </x-tmk.list>

                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <x-tmk.livewire-log :genres="$genres" />
</div>
