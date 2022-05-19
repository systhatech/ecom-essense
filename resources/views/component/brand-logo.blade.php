{{-- @dd($brandsData) --}}
{{-- /getFile?path=brand/attachments&file=626f7cdf29725_download.png --}}
<?php
    $count = 0;
?>
<div class="brands-area d-flex align-items-center justify-content-between">
     @foreach ($brandsData as $brand)
        @if($count<6)
            @php
                $count++;
            @endphp
            <div class="single-brands-logo">           
                <h3>{{$brand['name']}}</h3>    
                <img src="{{config('app.server_url')}}/getFile?path=brand/attachments&file={{$brand['brand_image']??''}}" alt="{{$brand['name']}}">
            </div>            
        @endif
     @endforeach
       
</div>