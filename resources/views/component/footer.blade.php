
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row">
            <!-- Single Widget Area -->
            <div class="col-12 col-md-6">
                <div class="single_widget_area d-flex mb-30">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="home"><img src="/img/core-img/logo2.png" alt=""></a>
                    </div>
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <ul>
                            <li><a href="/menu/23">Shop</a></li>
                            {{-- <li><a href="/blog">Blog</a></li> --}}
                            <li><a href="/contact">Contact</a></li>
                            <li><a href="/wish">Favourite</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-md-6">
                <div class="single_widget_area mb-30">
                    <ul class="footer_widget_menu">                        
                            @foreach ($data['data']['footer_menus'] as $key =>$item)  
                               <li><a href="/menu/{{$item['id']}}">{{$item['menu_name']}}</a></li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <!-- Single Widget Area -->
            <div class="col-12 col-md-6">
                <div class="single_widget_area">
                    <div class="footer_heading mb-30">
                        <h6>Subscribe</h6>
                    </div>
                    <div class="subscribtion_form">
                        <form action="#" method="post">
                            <input type="email" name="sub_email" class="inSub_email" placeholder="Your email here">
                            <button type="submit" class="submit sub_email"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-md-6">
                <div class="single_widget_area">
                    <div class="footer_social_area">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>

<div class="row mt-5">
            <div class="col-md-12 text-center">
                <p>
                    
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved || By {{isset($data['data']['vendor'])?$data['data']['vendor']['name'] : 'Essences Shoping' }}

                </p>
            </div>
        </div>

    </div>
</footer>
<!-- ##### Footer Area End ##### -->

<!-- jQuery (Necessary for All JavaScript Plugins) -->

<script src="{{asset('EssencesSite/js/all.js')}}"></script>
<script>
    $(".sub_email").on('click',function(e)
    {   e.preventDefault();
        let sub_mail_data = $("[name='sub_email']").serializeArray();
        supportAjax(
            {
                url: "/subscribe",
                method:"POST",
                data: sub_mail_data,
            },
            (response)=>{
                toastr.success('Subscription Added');
            },
            (error)=>{
                console.log(error);
            }
        );
    })
</script>
</body>
<div id="loader-wrapper">
        <div id="loader"></div>
</div>

</html>