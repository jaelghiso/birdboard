@if($errors->{ $bag ?? 'default'}->any())
    <ul class="field mt-6 list-reset">
        @foreach ($errors->{ $bag ?? 'default'}->all() as $error)
            <li class="text-sm text-red-800 bg-red-200 p-2 rounded">{{ $error }}</li>
        @endforeach
    </ul>
@endif
