<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="utf-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>@yield('title')</title>
            <meta name="keywords" content="@yield('keywords')">
            <meta name="description" content="@yield('description')">

            <meta name="google-site-verification" content="v79F1JB3qn8-MtBtlY7WDQAztY0O_BBwYQyR5L1_ibM" />
            
            <!-- Favicons -->
            <link href="{{asset('assets/img/favicon.ico')}}" rel="icon" type="image/x-icon">
            <link href="{{asset('assets/img/favicons.png')}}" rel="apple-touch-icon">
            <link href="{{asset('css/responsivecode.css')}}" rel="stylesheet"> 


<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1582065748888864');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1582065748888864&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

            
            @php
            $settings=App\Models\theme_settings::first();
            @endphp

            <style>
                .base_color_background {background-color:{{ $settings->theme_color ?? '#484848' }};}
                .color_code {color:{{ $settings->theme_color ?? '#484848' }};}
                #base_color_background {background-color:{{ $settings->theme_color ?? '#484848' }};}
                #color_code_chackout_icon{color:{{ $settings->theme_color ?? '#484848' }};}
                #cart_header_small{padding:1.5px; background:{{ $settings->theme_color ?? '#484848' }};}

                /* cart dropdown buttons */
                #btn_color1{background-color: {{ $settings->theme_color ?? '#484848' }};color:#fdfdfd}
                #btn_color1:hover{background-color: grey;color:#fdfdfd;transition: all 0.5s ease-in-out 0s;} 
                #btn_color2{background-color: #8C8B88;color:#fdfdfd;}
                #btn_color2:hover{background-color: #b9b9b9;color:#fdfdfd;transition: all 0.5s ease-in-out 0s;}


                #mh_borderx {
                   background: {{ $settings->theme_color ?? '#484848' }};
                   height: 25px;
                   padding-left: 10px;
                   color: white;
               } 


               #user_home_btn{background: {{ $settings->theme_color ?? '#484848' }};color: white;}
               #user_home_btn:hover{background: gray;}
               #user_home_btn_session_count{background: orange; font-size: 14px;}
               #user_update_profile{background:{{ $settings->theme_color ?? '#484848' }}; color:white; }
              



                #continue_shopping_btn{
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white; font-weight:700;
                    border-radius:30px;
                    transition: all 0.5s ease-in-out 0s;
                    }

                #continue_shopping_btn:hover{background: gray;} 

                #procced_to_checkout{
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white; 
                    font-weight:700;
                    width:100%;
                    transition: all 0.5s ease-in-out 0s;
                    }

                #procced_to_checkout:hover{background:grey;}

                #currently_empty_cart{
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white; 
                    font-weight:700;
                    border-radius:30px;
                   }
                
                /** mobile */
                #procced_to_checkout_mobile{
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white; 
                    font-weight:700;
                    width:100%;
                   }
                
                #currently_empty_cart_empty{
                    border-radius:30px;
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white;
                }

                #auth_login_btn{
                    background:{{ $settings->theme_color ?? '#484848' }}; 
                    color:white; 
                    font-weight:700;
                }


               /* ADD TO CART HOMEPAGE WELCIME */
               #base_color_addtoCart{
                   background-color:  {{ $settings->theme_color ?? '#484848' }};
                   color:#fdfdfd;
                   border-radius: 30px;
                   width:100%; 
                   margin:0 auto;
               }

             #base_color_addtoCart:hover{
                 background-color: gray;
                 color:#fdfdfd;
                 border-radius: 30px;
                 width:100%; 
                 margin:0 auto;
             }

            .base_color_addtoCart{
                background-color: {{ $settings->theme_color ?? '#484848' }};
                color:#fdfdfd;
                border-radius: 30px;
                width:100%; 
                margin:0 auto;
            }

           .base_color_addtoCart:hover{
               background-color:  gray;
               color:#fdfdfd;
               border-radius: 30px;
               width:100%; 
               margin:0 auto;
           }

            /*** PRODUCT PAGE ADD TO CART ***/
            .addToCart_Product{
            background: {{ $settings->theme_color ?? '#484848' }};
            color: #fff;
            padding: 7px 45px;
            display: inline-block;
            margin-top: 20px;
            border-radius: 30px;
            border: 2px solid white;
            transition: all 0.5s ease-in-out 0s;
            }

            .addToCart_Product:hover{
            background: grey;
            color: #fff;
            padding: 7px 45px;
            display: inline-block;
            margin-top: 20px;
            border-radius: 30px;
            border: 2px solid white;
            transition: all 0.5s ease-in-out 0s;
            }

            /* News Letter */
            #newsletter{
                background:{{ $settings->theme_color ?? '#484848' }}; 
                color:white;
                font-weight: bold;
                border-radius: 100px;
               
            }

            #newsletter:hover{
                background:grey; 
            }

          /** pagination color CSS */
          [aria-current] .page-link {background-color: {{ $settings->theme_color ?? '#484848' }} !important;}



        /** Categories **/
        #categories{
        color:black;background:{{ $settings->theme_color ?? '#484848' }}; 
        font-weight:bold; padding:13px;color:white;
        width:300px;border-radius: 15px 15px 0px 0px;
        z-index:10000;
          }


        /*** HEADER ***/
        .header{
            background:{{ $settings->theme_color ?? '#484848' }};
            padding:10px;
            color:wheat;}

        /********************** mobile menu **********************/
        #mobileLi{
            background:{{ $settings->theme_color ?? '#484848' }}; 
            font-weight:bold; padding:8px;
            border-radius: 10px 10px 0px 0px; 
            padding-right:55px;}

        #mh_border{
            background:orange; 
            height:25px; 
            padding-left:10px;
            color:white;}

        /*** CATEGORY UL LI HOVER*/
        .on > a,
        .mainnav li:hover > a {
          background: #f2f2f2;
          color: {{ $settings->theme_color ?? '#484848' }};
          font-weight: bold;
        }


        </style>

            
            <!-- css links -->
            <link href="{{asset('css/main.css')}}" rel="stylesheet">
            <link href="{{asset('css/richtext.min.css')}}" rel="stylesheet">
            <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/css/mdb.min.css" rel="stylesheet">
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
            
            <link rel="stylesheet" href="css/alertify.min.css"/>
            
            <!--<link href="https://fonts.googleapis.com/css2?family=ABeeZee&family=Acme&family=Balsamiq+Sans&family=Bowlby+One+SC&family=Fredoka+One&family=Josefin+Sans:wght@700&family=Lobster&display=swap" rel="stylesheet"> -->
                
            <!-- font Cairo CSS -->
            <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">

            <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
                

            <!-- all scripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.10.1/js/mdb.min.js"></script>
              
    </head>



<body id="body">
    @include('Reusable_components.user.header')
    @yield('content')
    @include('Reusable_components.user.footer')
    <style>.wow{animation-name: none;}</style>
    
    <!-- footer scripts-->
    <!--<script src="{{asset('assets/js/main.js')}}"></script>-->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/cart.js')}}"></script>
    <script src="{{asset('js/jquery.richtext.js')}}"> </script> 
    <script src="{{asset('js/jquery.richtext.min.js')}}"> </script> 
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  
    </body>
</html>
