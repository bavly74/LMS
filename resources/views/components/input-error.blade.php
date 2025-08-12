@props(['messages'])

@if ($messages)
    <ul {{ $attributes }} style="color: #8c0000">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
