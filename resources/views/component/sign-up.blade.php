<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg); margin-top:75px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Sign Up</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-0 py-lg-5">
    <div class="container">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
            style="height: auto;">
            <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                        <p>Already have an account? <a href="/login">Sign in here</a>
                                    </p>
                                </div>
                                {{-- <div class="d-grid">
                                    <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span
                                            class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="assets/images/icons/search.svg" width="16"
                                                alt="Image Description">
                                            <span>Sign Up with Google</span>
                                        </span>
                                    </a> <a href="javascript:;" class="btn btn-white"><i
                                            class="bx bxl-facebook"></i>Sign Up with Facebook</a>
                                </div>
                                <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                                    <hr />
                                </div> --}}
                                <div class="form-body">
                                    <form class="row g-3" id="signUpForm">
                                        @csrf
                                        <div class="col-sm-6">
                                            <label for="inputFirstName" class="form-label">First Name</label>
                                            <input type="text" name="fname" class="form-control" id="inputFirstName"
                                                placeholder="Enter First name" required>
                                            <div class="errorMessage"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputLastName" class="form-label">Last Name</label>
                                            <input type="text" name="lname" class="form-control" id="inputLastName"
                                                placeholder="Enter Last Nmae" required>
                                            <div class="errorMessage"></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="inputEmailAddress"
                                                placeholder="example@user.com" required>
                                            <div class="errorMessage"></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0"
                                                    id="inputChoosePassword" placeholder="Enter Password" required> 
                                                <div class="errorMessage"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePasswordConfirmation"
                                                class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control border-end-0"
                                                    id="inputChoosePasswordConfirmation" placeholder="Enter Password" required>
                                                <div class="errorMessage"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-dark" id="clientSignUp"><i
                                                        class='bx bx-user'></i>Sign up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</section>

<script>
    $('#clientSignUp').on('click',function(e){
        e.preventDefault();
        const form = $("#signUpForm");
        const data = $("#signUpForm").serializeArray();
        supportAjax({
           url : '/register',
           method : 'POST',
            data
            },
            (response)=>{
               window.location.href ='/login';
              
            },
            ({status, responseJSON })=>{
               
                if (status === 422) {
                form.find("input[name], textarea[name]").css("border-color", "#ddd");
                $(`input[name]`).siblings(".errorMessage").empty();
                if (!responseJSON.errors) return;
                const messages = [];
                for (const [key, message] of Object.entries(responseJSON.errors)) 
                    {
                        form.find(`input[name="${key}"]`).css("border-color", "#f44336");
                        form.find(`textarea[name="${key}"]`).css("border-color", "#f44336");
                    
                        messages.push(message);
                        $(`[name="${key}"]`).parent().children(".errorMessage").empty().append(message);
                    }
                }
            }
        )
       })
        // $.ajax({
        //     url:'/register',
        //     method:'POST',
        //     data:data,
        //     success:function(){
        //         window.location.href ='/login';
                
        //     },
        //     error:function(){
        //         alert('error');
        //     }
        // });
</script>