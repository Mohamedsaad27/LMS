<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="{{ env('APP_NAME') }}">
    {{-- <meta name="description" content=""> --}}
    {{-- <meta name="keywords" content="" /> --}}
    {{-- <link rel="canonical" href=""> --}}

    <!-- Open Graph / Facebook "when shared on social media platforms"-->
    {{-- <meta property="og:type" content="website"> --}}
    {{-- <meta property="og:url" content=""> --}}
    {{-- <meta property="og:title" content=""> --}}
    {{-- <meta property="og:description" content=""> --}}
    {{-- <meta property="og:image" content=""> --}}

    <!-- Twitter -->
    {{-- <meta property="twitter:card" content="">
    <meta property="twitter:url" content="">
    <meta property="twitter:title" content="">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content=""> --}}

    <!-- Favicon -->
    {{-- <link rel="apple-touch-icon" sizes="120x120" href="">
    <link rel="icon" type="image/png" sizes="32x32" href="">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <link rel="manifest" href="">
    <link rel="mask-icon" href="" color="">
    <meta name="msapplication-TileColor" content="">
    <meta name="theme-color" content=""> --}}

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.css"
        as="style" type="text/css">

    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" as="style"
        type="text/css">

    <!-- LMS CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/lms.css') }}">

    <!-- Preloader CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/preloader.css') }}">
</head>

<body>
    <main>
        <!-- Section -->
        <section class="vh-lg-100 mt-8 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="{{ asset('assets/imgs/signin.svg') }}">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-400">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3 fw-bolder" data-i18n="title_login">Sign in to LMS</h1>
                            </div>
                            <form action="{{ route('login') }}" method="POST" class="mt-4">
                                @csrf

                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email" data-i18n="label_email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="example@company.com"
                                            value="{{ old('email') }}" id="email" name="email" autofocus
                                            required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-1">
                                        <label for="password" data-i18n="label_password">Password</label>
                                        <div class="input-group">
                                            <input type="password" placeholder="Password" class="form-control"
                                                id="password" name="password" required
                                                input-data-i18n="label_password">
                                        </div>
                                        @error('email')
                                            <div class="text-danger fs-7">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- End of Form -->
                                    <div class="d-flex justify-content-between align-items-top mb-4">
                                        <div><a href="./forgot-password.html" class="small text-right fw-bold"
                                                data-i18n="forget_password">
                                                Forget Your Password password ?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800 hover:btn-gray-900"
                                        data-i18n="sign_in">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="https://cdn.jsdelivr.net/npm/onscreen@1.4.0/dist/on-screen.umd.min.js"></script>


    <!-- Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.8.1/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.polyfills.min.js"></script>

    <!-- Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-tooltip/0.0.11/chartist-plugin-tooltip.min.js">
    </script>

    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

    <!-- Notyf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.2.7/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- LMS JS -->
    <script src="{{ asset('assets/js/dashboard/lms.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Language JS -->
    <script src="{{ asset('assets/js/dashboard/translations.js') }}" type="module"></script>

</body>

</html>
