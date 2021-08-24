@extends('auth.app')
@section('title', 'Login')
@section('content')
<div class="d-flex flex-column flex-root">
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        {{-- <div class="login-aside d-flex flex-column flex-row-auto" style="background-image: url({{ asset('media/bg/banner_1.jpg') }});"> --}}
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #E8F4FF;">
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <a href="#" class="text-center mb-10">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" class="max-h-70px" alt="" />
                </a>
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #ff2a1b;">
					Welcome to<br>Metronic Laravel 7 Framework
				</h3>
            </div>
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/illustrations/login-visual-1.svg)"></div>
        </div>
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <div class="d-flex flex-column-fluid flex-center">
                <div class="login-form login-signin">
                    <form class="form" method="post" action="{{ route('login') }}" novalidate="novalidate" id="kt_login_signin_form">
                        @csrf
                        <div class="pb-13 pt-lg-0">
							{{-- <img src="{{ asset('media/logos/logo.png') }}" class="max-h-55px" alt="" /> --}}
                            <span class="font-weight-bolder text-dark font-size-h1-lg align-middle">Login</span>
                        </div>
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Username</label>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('email') is-invalid @enderror" type="text" id="username" placeholder="Masukkan username" name="username" autocomplete="off" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
							<div class="d-flex justify-content-between" style="width: 100%">
								<div class="font-size-h6 font-weight-bolder text-dark pt-2">Password</div>
								{{-- <div class="text-primary font-size-h6 text-dark pt-2"><a href="#">Lupa Password ?</a></div> --}}
							</div>
                            </div>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('password') is-invalid @enderror" id="password" type="password" placeholder="Masukkan password" name="password" autocomplete="off" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- Captcha (if u wanna use just un-comment it) --}}
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-7 col-7">
                                    <img src="{{ captcha_src('default') }}" id="captchaCode" alt="" class="captcha img-responsive img-fluid">
                                    <div>
                                        <a href="javascript:void(0)" class="reloadCaptcha">
                                            Reload Captcha
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5 col-5">
                                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" id="captcha" type="text" placeholder="" name="captcha" autocomplete="off" />
                                </div>
                            </div>
                        </div> --}}
                        {{-- Captcha --}}
                        <div class="pb-lg-0 pb-5 row">
                            <div class="col-lg-4">
                                <button type="submit" id="btnLogin" class="btn btn-primary btn-block font-weight-bolder font-size-h6">
                                    <span>Log in</span>
                                    <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Angle-double-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"/>
                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                                        </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </button>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('register') }}" class="btn btn-warning btn-block font-weight-bolder font-size-h6">
                                    Register &nbsp; <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('css/pages/login/login-1.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/custom/login/login-general.js?v=7.0.6') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.reloadCaptcha').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('login.recaptcha') }}",
                    type: 'get',
                    success: function(response) {
                        $('#captchaCode').attr('src', response);
                        // $.ajax({
                        //     url: response,
                        //     type: 'get',
                        //     success: function(response) {
                        //         // console.log(response);
                        //         $('#captchaCode').attr('src');
                        //     }
                        // })
                    } 
                })
            })
        })
    </script>
@endsection