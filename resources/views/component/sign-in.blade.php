
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg); margin-top:75px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Sign In</h2>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
            style="height: auto;">
           <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">                                    
                                    <p>Don't have an account yet? <a href="/register">Sign up here</a>
                                    </p>
                                </div>
                                {{-- <div class="d-grid">
                                    <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span
                                            class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="assets/images/icons/search.svg" width="16"
                                                alt="Image Description">
                                            <span>Sign in with Google</span>
                                        </span>
                                    </a> <a href="javascript:;" class="btn btn-white"><i
                                            class="bx bxl-facebook"></i>Sign in with Facebook</a>
                                </div>
                                <div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
                                    <hr />
                                </div> --}}
                                <div class="form-body">
                                    <form class="row g-3" id="loginForm">
                                        @csrf
                                        <div class="col-12">                                       
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="inputEmailAddress"
                                                placeholder="Email Address">
                                                <div class="errorMessage"></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0"
                                                    id="inputChoosePassword" placeholder="Enter Password" style='width:100%'> 
                                                <div class="errorMessage"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckChecked" checked name="remember_token">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end"> <a
                                                href="authentication-forgot-password.html">Forgot Password ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" id="userLogin"><i
                                                        class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
                       
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

<script>
    $('#userLogin').on('click', function(e) {
        e.preventDefault();
        const form  = $('#loginForm');
        const data = $('#loginForm').serializeArray();
        supportAjax({
            url:'/login',
            method: "POST",
            data: data
        }, (resp) => {
                //window.location.reload();
                window.location.href ='/home';
        }, ({status, responseJSON}) => {
           
            if (status === 422) {
                form.find("input[name], textarea[name]").css("border-color", "#ddd");
                
                $(`input[name]`).siblings(".errorMessage").empty();
                if (!responseJSON.errors) return;
                const messages = [];
                for (const [key, message] of Object.entries(responseJSON.errors)) {
                    form.find(`input[name="${key}"]`).css("border-color", "#f44336");
                    form.find(`textarea[name="${key}"]`).css("border-color", "#f44336");
                    messages.push(message);
                    $(`[name="${key}"]`).parent().children(".errorMessage").empty().append(message);
                }
            }
        })
    })
</script>