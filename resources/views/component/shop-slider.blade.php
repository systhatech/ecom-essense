
<div class="breadcumb_area bg-img" style="background-image: url(/img/bg-img/breadcumb.jpg);margin-top:78px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    @if (isset($data['data']['menu_name']))
                        <h2>{{$data['data']['menu_name']}}</h2>
                    @else
                       @php
                        $uri = $_SERVER['REQUEST_URI'];               
                        $value = explode('/', $uri)
                       @endphp
                            @if ($value[1]!='')
                                @php $data = explode('?',$value[1]) @endphp
                                <h2>{{$data[0]}}</h2>                                
                            @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>