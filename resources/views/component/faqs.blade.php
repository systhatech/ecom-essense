
<div class="breadcumb_area bg-img" style="background-image: url(/img/bg-img/breadcumb.jpg);margin-top:78px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>{{$data['data']['menu_name']}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="checkout_area section-padding-80 ">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-md-12">
                <div class="order-details-confirmation">
                    <div id="accordion">
                        {{-- @foreach ($component->posts as $post)
                            <div class="card">
                                <div class="card-header" id="headingOne{{$post->id}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$post->id}}" aria-expanded="true"
                                            aria-controls="collapseOne{{$post->id}}">
                                            {{$post->title}}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne{{$post->id}}" class="collapse show" aria-labelledby="headingOne{{$post->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                        {{$post->highlight}}
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                        <div class="card">
                            <div class="card-header" id="headingOne1">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true"
                                        aria-controls="collapseOne1">                                       
                                            <h6> What are your Payment options?</h6>
                                    </button>
                                </h5>
                            </div>                    
                            <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordion" style="margin-top: -35px;">
                                <div class="card-body" style="margin-left: 10px;"        >                            
                                        <p>Our Payment options are COD ( Cash on Delivery), Paypal , Bank Trasfer and many more.</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo2">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true"
                                        aria-controls="collapseTwo2">                                       
                                            <h6> How long does it take to recieve product after order?</h6>
                                    </button>
                                </h5>
                            </div>                    
                            <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordion" style="margin-top: -35px;">
                                <div class="card-body" style="margin-left: 10px;"        >                            
                                        <p>If all the conditions are meet, than all the process and the delivery of the product is done within 4 to 7 working days.</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree3">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree3" aria-expanded="true"
                                        aria-controls="collapseThree3">                                       
                                            <h6> What are the return policies?</h6>
                                    </button>
                                </h5>
                            </div>                    
                            <div id="collapseThree3" class="collapse" aria-labelledby="headingThree3" data-parent="#accordion" style="margin-top: -35px;">
                                <div class="card-body" style="margin-left: 10px;"        >                            
                                        <p>All the return policies are  mention in <a href="/menu/40"> Return Polices</a>. Please follow the link.</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
