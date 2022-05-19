<!-- ##### Top Catagory Area Start ##### -->
<div class="top_catagory_area section-padding-80 clearfix">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Catagory -->
            @foreach ($data['data']['categories'] as $key =>$category)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img"
                        style="background-image: url({{config('app.server_url')}}/getFile?path=categories/images&file={{$category['category_image']??''}});">
                        <div class="catagory-content">
                            <a href="/category/{{$category['id']}}">{{$category['category_name']}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</div>
{{-- @dd($data['data']['categories']) --}}

   