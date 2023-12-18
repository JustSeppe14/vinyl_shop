<div>
    <x-tmk.section

        x-data="{open: false}"
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="flex-1">
            <x-input id="search" type="text" placeholder="Filter Name"
                     wire:model.live.debounce.500ms="search"
                     wire:keydown.escape="resetValues()"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
        <x-input-error for="filter" class="m-4 -mt-4 w-full"/>
    </x-tmk.section>

    <x-tmk.section>
        <div class="my-4">{{$users->links()}}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-1/4">
                <col class="w-1/4">
                <col class="w-1/4">
                <col class="w-1/4">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2 cursor-pointer">
                <th wire:click="resort('name')">
                    <span data-tippy-content="Order by name">Name</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'id' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th wire:click="resort('email')">
                <span data-tippy-content="Order by email">
                    Email
                </span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'id' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th wire:click="resort('active')">
                    <span data-tippy-content="Order by active account">Active</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'id' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th wire:click="resort('admin')">
                    <span data-tippy-content="Order by admin account">Admin</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'id' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr
                    wire:key="user-{{$user->id}}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    @if($editUser['name'] !== $user->name)
                        <td
                            wire:click="edit({{$user->id}})"
                            class="text-left cursor-pointer">{{$user->name}}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left w-64">
                                <x-input id="edit_{{ $user->name }}" type="text"
                                         x-init="$el.focus()"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editUser.name"
                                         wire:keydown.enter="updateName({{$user->name}})"
                                         wire:keydown.tab="updateName({{$user->name}})"
                                         wire:keydown.escape="resetValues()"
                                         class="w-64"/>

                                <x-input-error for="editUser.name" class="mt-2"/>
                            </div>
                        </td>
                    @endif
                    @if($editUser['email'] !== $user->email)
                        <td
                            wire:click="edit({{$user->id}})"
                            class="text-left cursor-pointer">{{$user->email}}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left w-64">
                                <x-input id="edit_{{ $user->email }}" type="text"
                                         x-init="$el.focus()"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editUser.email"
                                         wire:keydown.enter="updateMail({{$user->email}})"
                                         wire:keydown.tab="updateMail({{$user->email}})"
                                         wire:keydown.escape="resetValues()"
                                         class="w-64"/>

                                <x-input-error for="editUser.email" class="mt-2"/>
                            </div>
                        </td>
                    @endif
                    <td>{{$user->active}}</td>

                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">{{$users->links()}}</div>
    </x-tmk.section>
</div>
