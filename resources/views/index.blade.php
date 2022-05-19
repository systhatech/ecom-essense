{{-- @dd($data['data']['home_components'])
@foreach($dataComp as $item)
    @include('EssencesSite::component.'.$item)
@endforeach --}}



    {{-- // using component form api  --}}
{{-- @dd($data) --}}
    @if(isset($data['data']['home_components']) && count($data['data']['home_components']))
        @foreach($data['data']['home_components'] as $component)
            @if(View::exists('EssencesSite::component.' . $component['title']))
                @include('EssencesSite::component.' . $component['title']
                //  ,['post' => $component['posts']]
                 )
            @endif
        @endforeach
    @else
        @foreach($data['data']['component'] as $component)
            @if(View::exists('EssencesSite::component.' . $component['title']))
               @include('EssencesSite::component.' . $component['title']
            // ,['post' => $component['posts']]
            )
            @endif
        @endforeach
    @endif
