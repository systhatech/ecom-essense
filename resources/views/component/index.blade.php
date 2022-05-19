
{{-- @dd($data); --}}
@foreach($dataComp as $item)
    @include('component.'.$item)
@endforeach