{{-- @dd($data['data']['offers']) --}}
@if(count($data['data']['offers']) > 0)
    @foreach ($data['data']['offers'] as $key => $item)
        <section class="welcome_area bg-img background-overlay"
            style="background-image: url({{config('app.server_url')}}/getFile?path=offer/thumbnail&file={{ $item['thumbnail'] ?? '' }})">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-content">
                            <h6>Offer</h6>
                            <h2>{{$item['name']}}</h2>
                            <a href="/offers/{{$item['id']}}" class="btn essence-btn">view collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@else
    <!-- Default when no offer ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2>New Collection</h2>
                        {{-- <a href="/menu/23" class="btn essence-btn">view collection</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


