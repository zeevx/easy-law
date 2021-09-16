<!DOCTYPE html>

@if(rtl())
    <html dir="rtl" class="rtl">
    @else
        <html>
        @endif
        <head>

            <!-- Required meta tags -->
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <link rel="icon" href="{{ asset(config('configs')->where('key','favicon_logo')->first()->value) }}"
                  type="image/png"/>

            <title>{{ isset($title) ? $title .' | '. config('configs')->where('key','site_title')->first()->value :  config('configs')->where('key','site_title')->first()->value }}</title>

            <meta name="_token" content="{!! csrf_token() !!}"/>


            <!-- Bootstrap CSS -->


            @if(rtl())
                <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/bootstrap.min.css')}}"/>
            @else
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
            @endif


            <link rel="stylesheet" href="{{asset('public/frontend/')}}/vendors/font_awesome/css/all.min.css"/>

            <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
            <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
            <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>


            @yield('css')


            @if(rtl())
                <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/style.css')}}"/>
                <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/infix.css')}}"/>
            @else
                <link rel="stylesheet" href="{{asset('public/backEnd/css/style.css')}}"/>
                <link rel="stylesheet" href="{{asset('public/backEnd/css/infix.css')}}"/>
            @endif

            <link rel="stylesheet" href="{{asset('public/frontend/')}}/css/style.css"/>
            <!--  -->
            @stack('css_before')

            <style>
                #main-content {
                    margin-right: 0;
                    margin-left: 0;
                    overflow: hidden;
                }

                @media (min-width: 1200px) {
                    #main-content {
                        padding: 0px;
                    }
                }

                #main-content {
                    width: 100%;
                }
                .white-box{
                    padding: 0px;
                }
                .student-details{
                    margin-top: 0px;
                }

            </style>

        </head>

        <body>

        <div class="main-wrapper" >

            <div id="main-content">

                @yield('mainContent')


            </div>
        </div>


        <!-- ================Footer Area ================= -->
        <footer class="footer-area">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <p> {!! config('configs')->where('key', 'copyright_text')->first()->value !!} </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ================End Footer Area ================= -->


        <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.4.1.min.js"></script>

        <script src="{{asset('public/backEnd/')}}/vendors/js/popper.js">
        </script>

        <script src="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.js"></script>

        {!! Toastr::message() !!}
        @stack('admin.scripts')
        @stack('js_before')
        @stack('js_after')
        @stack('scripts')
        <script type="text/javascript">

            $(document).ready(function (){
                window.print();
                setTimeout(function (){
                    window.close()
                }, 3000);
            })

        </script>


        @yield('script')

        </body>
        </html>


