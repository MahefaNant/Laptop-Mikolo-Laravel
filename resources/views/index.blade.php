@extends('template.htmlTemplate')

@section('content')

    <link href=" {{ asset("assets/metronic/css/plugins.bundle.css") }} " rel="stylesheet" type="text/css"/>
    <link href=" {{ asset("assets/metronic/css/style.bundle.css") }}" rel="stylesheet" type="text/css"/>


    <style>
        section {
            background-image: url(' {{ asset("assets/media/back/bg5-dark.jpg") }}');
            background-size: auto;
        }


        [data-bs-theme="dark"] section {
            background-image: url('{{ asset("assets/media/back/bg4.jpg") }}');
        }

    </style>

    <section id="kt_body"  class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">

        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="../../../index.html" class="mb-7">
                        <img alt="Logo" src="{{ asset("assets/media/logos/custom-3.svg") }}"/><h1 class="h1 text-danger">MIKOLO</h1>
                    </a>
                    <!--end::Logo-->

                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">
                        Branding tools designed for your business
                    </h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <br><br><br><br><br>
                        <!--begin::Form-->
                        <form action="{{ route('loginUser') }}" method="POST" class="form w-100">
                        <!--begin::Heading-->{{ csrf_field() }}
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">
                                Sign In
                            </h1>
                            <!--end::Title-->

                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">
                                Your Social Campaigns
                            </div>
                            <!--end::Subtitle--->
                        </div>
                        <!--begin::Heading-->

                        <!--begin::Login options-->
                        <div class="row g-3 mb-9">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Google link--->
                                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{ asset("assets/media/svg/brand-logos/google-icon.svg") }}" class="h-15px me-3"/>
                                    Sign in with Google
                                </a>
                                <!--end::Google link--->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Google link--->
                                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{ asset("assets/media/svg/brand-logos/apple-black.svg") }}" class="theme-light-show h-15px me-3"/>
                                    <img alt="Logo" src="{{ asset("assets/media/svg/brand-logos/apple-black-dark.svg") }}" class="theme-dark-show h-15px me-3"/>
                                    Sign in with Apple
                                </a>
                                <!--end::Google link--->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Login options-->

                        <!--begin::Separator-->
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                        </div>
                        <!--end::Separator-->

                        <!--begin::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="mail" value="user1@gmail.com" autocomplete="off" class="form-control bg-transparent"/>
                            <!--end::Email-->
                        </div>

                        <!--end::Input group--->
                        <div class="fv-row mb-3">
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="code" value="user1" autocomplete="off" class="form-control bg-transparent"/>
                            <!--end::Password-->
                        </div>

                        <div class="form-check d-flex justify-content-center mb-4">
                            <input name="remember_me" class="form-check-input me-2" type="checkbox" value="1" id="form2Example33" checked />
                            <label class="form-check-label" for="form2Example33">
                                Remember me
                            </label>
                        </div>


                        <!--end::Input group--->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>

                            <!--begin::Link-->
                            <a href="{{ route('signUpPage') }}" class="link-primary">
                                SIGN-UP
                            </a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">

                                <!--begin::Indicator label-->
                                <span class="indicator-label">Sign In</span>
                                <!--end::Indicator label-->

                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->

                        </form>
                        <!--end::Form-->

                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Footer-->
                    <div class="d-flex flex-stack px-lg-10">
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a  target="_blank">ETU 1557 MahefaNant@gmail.com </a>

                            <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                ADMIN
                            </a>
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>

    </section>


    <script src=" {{ asset("assets/metronic/js/plugins.bundle.js") }} "></script>
    <script src=" {{ asset("assets/metronic/js/scripts.bundle.js") }}"></script>
    <script src="{{ asset("assets/metronic/js/custom/authentication/sign-in/general.js") }}"></script>


@endsection


<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ADMIN AUTHENTIFICATION</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminAuthentification') }}" method="POST" class="row g-3">
                    {{ csrf_field() }}
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">mail</label>
                        <input name="mail" type="email"  id="inputEmail4" value="magasin1@gmail.com">
                    </div>
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">mot de passe</label>
                        <input name="code" type="password"  id="inputEmail4" value="magasin1">
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">VALIDER</button>
                </form>
            </div>
        </div>
    </div>
</div>
