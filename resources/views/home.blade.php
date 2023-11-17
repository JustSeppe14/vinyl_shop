<x-vinylshop-layout>
    <x-slot name="description">New description</x-slot>
    <x-slot name="title">Welcome to the Vinyl Shop</x-slot>

    <p>Welcome to the website of The Vinyl Shop, a large online store with lots of (classic) vinyl records.</p>

{{--    //link with URL--}}
{{--    <a href="/contact">Contact</a>--}}

{{--    //Link with route name--}}
{{--    <a href="{{ route('contact') }}">Contact</a>--}}
    <h3>Random quotes</h3>
    <livewire::quote/>
    <hr>
    @livewire('quote')

    @push('script')
        <script>
            console.log('The Vinyl Shop JavaScript works! 🙂')
        </script>
    @endpush
</x-vinylshop-layout>
