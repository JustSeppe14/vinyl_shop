<x-vinylshop-layout>
    <x-slot name="description">New description</x-slot>
    <x-slot name="title">Contact</x-slot>
    <h2>I'm {{$name}}</h2>
    <p>You can contact me at
        <a class="text-sky-600 underline" href="mailto:{{config('mail.from.address')}}">
            {{config('mail.from.address')}}
        </a>

    </p>
</x-vinylshop-layout>
