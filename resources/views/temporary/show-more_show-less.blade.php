<?php $desc = strip_tags(html_entity_decode($product->short_desc)); ?>
<div class="ellipsis-text" data-desc="{{$desc}}" style="display:inline-block;">
    @if(!is_null($product->short_desc))
    {{-- {{dd(strlen($product->short_desc))}} --}}
    @if(strlen($product->short_desc) >= 560)
    <p class="desc_text short_text" data-desc="{{$desc}}" style="padding: 10px;"> {!!
        \Illuminate\Support\Str::limit($desc, 560, $end='...') !!} <a href="#" class=" show-more"
            style="font-weight:bold;">Show More</a> </p>
    <p class="desc_text long_text" style="padding: 10px;display:none!important;" data-desc="{{$desc}}"> {!! $desc !!} <a
            href="#" class="show-less" style="font-weight:bold;">Show less</a> </p>
    @else
    <p class="desc_text long_text" data-desc="{{$desc}}" style="padding: 10px;"> {{$desc}}</p>
    @endif
    @endif

</div>
<script>
    <?php $desc = strip_tags(html_entity_decode($product->short_desc)); ?>
    <div class="ellipsis-text" data-desc="{{$desc}}" style="display:inline-block;">
        @if(!is_null($product->short_desc))
        {{-- {{dd(strlen($product->short_desc))}} --}}
        @if(strlen($product->short_desc) >= 560)
        <p class="desc_text short_text" data-desc="{{$desc}}" style="padding: 10px;"> {!!
            \Illuminate\Support\Str::limit($desc, 560, $end='...') !!} <a href="#" class=" show-more"
                style="font-weight:bold;">Show More</a> </p>
        <p class="desc_text long_text" style="padding: 10px;display:none!important;" data-desc="{{$desc}}"> {!! $desc !!} <a
                href="#" class="show-less" style="font-weight:bold;">Show less</a> </p>
        @else
        <p class="desc_text long_text" data-desc="{{$desc}}" style="padding: 10px;"> {{$desc}}</p>
        @endif
        @endif
    
    </div>
</script>