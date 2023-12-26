<div>
    <x-tmk.section
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-input id="newGenre" type="text" placeholder="New genre"
                         class="w-full shadow-md placeholder-gray-300"/>
                <x-phosphor-arrows-clockwise
                    class="w-5 h-5 text-gray-200 absolute top-3 right-2 animate-spin"/>
            </div>
            <x-heroicon-o-information-circle
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newGenre" class="m-4 -mt-4 w-full"/>
        <div
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-tmk.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    <b>A new genre</b> can be added by typing in the input field and pressing <b>enter</b> or
                    <b>tab</b>. Press <b>escape</b> to undo.
                </li>
                <li>
                    <b>Edit a genre</b> by clicking the
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    icon or by clicking on the genre name. Press <b>enter</b> to save, <b>escape</b> to undo.
                </li>
                <li>
                    Clicking the
                    <x-heroicon-o-information-circle class="w-5 inline-block"/>
                    icon will toggle this message on and off.
                </li>
            </x-tmk.list>
        </div>
    </x-tmk.section>

    <x-tmk.section>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-14">
                <col class="w-20">
                <col class="w-16">
                <col class="w-max">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2 cursor-pointer">
                <th wire:click="resort('id')">
                    <span data-tippy-content="Order by id">#</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400 inline-block"/>
                </th>
                <th wire:click="resort('records_count')">
                <span data-tippy-content="Order by # records">
                    <x-tmk.logo class="w-6 mx-auto fill-gray-200 inline-block"/>
                </span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400 inline-block"/>
                </th>
                <th></th>
                <th wire:click="resort('name')" class="text-left">
                    <span data-tippy-content="Order by genre">Genre</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400 inline-block"/>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($genres as $genre)
            <tr class="border-t border-gray-300 [&>td]:p-2">
                <td>{{$genre->id}}</td>
                <td>{{$genre->records_count}}</td>
                <td>

                    <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                        <x-phosphor-pencil-line-duotone
                            class="w-5 text-gray-300 hover:text-green-600"/>
                        <x-phosphor-trash-duotone
                            class="w-5 text-gray-300 hover:text-red-600"/>
                    </div>
                </td>
                <td
                    class="text-left cursor-pointer">{{$genre->name}}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </x-tmk.section>
</div>
