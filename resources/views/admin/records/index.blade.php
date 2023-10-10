<x-vinylshop-layout>
    <x-slot name="title">Records</x-slot>

    <ul>
        @foreach($records as $index => $r)
            <li>Record{{$index}}: {{$r}}</li>

        @endforeach
    </ul>
    <hr>
    <ul>
        @foreach($records as $index => $record)
            <li>Record {{$index}}: {!! $record !!}</li>

        @endforeach
    </ul>
</x-vinylshop-layout>
