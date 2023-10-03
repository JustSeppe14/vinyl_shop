<h1>Records</h1>

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
