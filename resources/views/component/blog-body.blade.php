<?php
// $short_desc = $product->short_desc ;
// $blogDesc = Str::limit($short_desc,120, "..." )
?>

<div class="blog-wrapper section-padding-80">
    <div class="container">
        <div class="row" id="blogItems">
            <!-- Single Blog Area -->      
        </div>
    </div>
</div>
<script>
    getBlog();

    function getBlog(){
        supportAjax({
            url: '/blog',
            method: 'GET'
        },
        (resp)=>{
            
            const blog = resp.map((blog)=>{
                let image = `https://shop.systha.com/getFile?path=blogs/attachments&file=${blog.blog_image}`;
                let desc = blog.blog_content.slice(0,200);

                return ` <div class="col-12 col-lg-6"> 
                            <div class="single-blog-area mb-50">
                                <img src="${image}" alt="">
                               
                                <div class="post-title">
                                    <a href="#">${blog.blog_title}</a>
                                </div>
                               
                                <div class="hover-content">
                                   
                                    <div class="hover-post-title">
                                        <a href="#">${blog.blog_title}</a>
                                    </div>
                                    <p>${desc}...</p>
                                    <a href="/blog/${blog.id}" target="_blank">Continue reading <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div> 
                        </div>
                        `;
            })
            $("#blogItems").html(blog);
        });
    }
</script>