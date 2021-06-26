@extends('auth.app')
@section('title', 'Login')
@section('content')
<div class="d-flex flex-column flex-root">
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-image: linear-gradient(white, #fcf26a, #d72126, #0d2e37);">
            <div class="d-flex flex-column-auto flex-column mt-15">
                <a href="#" class="text-center mb-10">
                    <img src="{{ asset('media/logos/logo-jateng2.png') }}" class="max-h-90px" alt="" />
                </a>
                <h3 class="font-weight-bolder text-center font-size-h5">
					PEMERINTAH PROVINSI JAWA TENGAH <br />
					<span class="text-primary">Government Resources Management System</span>
				</h3>
            </div>
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ asset('media/bg/Master-01.png') }}); background-size: 63vh"></div>
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7 col-7">
                                    <img src="{{ captcha_src('flat') }}" id="captchaCode" alt="" class="captcha img-responsive img-fluid">
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
                        </div>
                        <div class="pb-lg-0 pb-5 row">
                            <div class="col-lg-5 col-4">
                                <button type="submit" id="btnLogin" class="btn btn-primary btn-block font-weight-bolder font-size-h6">Log In</button>
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