<?php
/*
 *Variaveis com o preenchimento obrigatório
 $page_header 
 $descricao_page_header
 $tituloPagina
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="#">
        <meta name="keywords" content="livro , folhas, batismo, batizado, casamento, crisma, registro, catedral, paroquia, imaculada, conceição">
        <meta name="author" content="#">
        <!-- TOKEN LARAVEL -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon icon -->
        <link rel="icon" href="{{asset('estilo_painel/assets/images/favicon.ico')}}" type="image/x-icon">
        <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/bootstrap/css/bootstrap.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/select2-develop/dist/css/select2.css')}}">
        
        <!-- themify-icons line icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/themify-icons/themify-icons.css')}}">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/icofont/css/icofont.css')}}">
        <!-- feather Awesome -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/feather/css/feather.css')}}">
        <!-- Notification.css -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/pages/notification/notification.css')}}">
        <!-- Animate.css -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/bower_components/animate.css/css/animate.css')}}">
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/style.css')}}">
       
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/jquery.mCustomScrollbar.css')}}">
        
        <!-- ion icon css -->
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/icon/ion-icon/css/ionicons.min.css')}}">

        <!-- animation nifty modal window effects css
        <link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/assets/css/component.css')}}"> -->

        <title>
            @if (!empty($tituloPagina))
            {{$tituloPagina}}
            @else
            Sem titulo
            @endif
        </title>
        @yield('css')
    </head>
    <body>
        <div class="theme-loader">
            <div class="ball-scale">
                <div class='contain'>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pre-loader end -->
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">

                        <div class="navbar-logo">
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="feather icon-menu"></i>
                            </a>
                            <a href="index-1.htm">
                                <img class="img-fluid" src="{{asset('estilo_painel/assets/images/logo.png')}}" alt="Theme-Logo">
                            </a>
                            <a class="mobile-options">
                                <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>

                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                               <!-- <li class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                        </div>
                                    </div>
                                </li>-->
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="feather icon-maximize full-screen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="feather icon-bell"></i>
                                            <span class="badge bg-c-pink">5</span>
                                        </div>
                                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li>
                                                <h6>Notifications</h6>
                                                <label class="label label-danger">New</label>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" src="estilo_painel/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">John Doe</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" src="estilo_painel/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">Joseph William</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" src="estilo_painel/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">Sara Soudein</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                            <i class="feather icon-message-square"></i>
                                            <span class="badge bg-c-green">3</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="{{asset('estilo_painel/assets/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                            <span>John Doe</span>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li>
                                                <a href="#!">
                                                    <i class="feather icon-settings"></i> Settings
                                                </a>
                                            </li>
                                            <li>
                                                <a href="user-profile.htm">
                                                    <i class="feather icon-user"></i> Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="email-inbox.htm">
                                                    <i class="feather icon-mail"></i> My Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="auth-lock-screen.htm">
                                                    <i class="feather icon-lock"></i> Lock Screen
                                                </a>
                                            </li>
                                            <li>
                                                <a href="auth-normal-sign-in.htm">
                                                    <i class="feather icon-log-out"></i> Logout
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Sidebar chat start -->
                <div id="sidebar" class="users p-chat-user showChat">
                    <div class="had-container">
                        <div class="card card_main p-fixed users-main">
                            <div class="user-box">
                                <div class="chat-inner-header">
                                    <div class="back_chatBox">
                                        <div class="right-icon-control">
                                            <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                            <div class="form-icon">
                                                <i class="icofont icofont-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-friend-list">
                                    <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius img-radius" src="{{asset('estilo_painel/assets/images/avatar-3.jpg')}}" alt="Generic placeholder image ">
                                            <div class="live-status bg-success"></div>
                                        </a>
                                        <div class="media-body">
                                            <div class="f-13 chat-header">Josephin Doe</div>
                                        </div>
                                    </div>
                                    <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius" src="{{asset('estilo_painel/assets/images/avatar-2.jpg')}}" alt="Generic placeholder image">
                                            <div class="live-status bg-success"></div>
                                        </a>
                                        <div class="media-body">
                                            <div class="f-13 chat-header">Lary Doe</div>
                                        </div>
                                    </div>
                                    <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius" src="{{asset('estilo_painel/assets/images/avatar-4.jpg')}}" alt="Generic placeholder image">
                                            <div class="live-status bg-success"></div>
                                        </a>
                                        <div class="media-body">
                                            <div class="f-13 chat-header">Alice</div>
                                        </div>
                                    </div>
                                    <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius" src="{{asset('estilo_painel/assets/images/avatar-3.jpg')}}" alt="Generic placeholder image">
                                            <div class="live-status bg-success"></div>
                                        </a>
                                        <div class="media-body">
                                            <div class="f-13 chat-header">Alia</div>
                                        </div>
                                    </div>
                                    <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                        <a class="media-left" href="#!">
                                            <img class="media-object img-radius" src="{{asset('estilo_painel/assets/images/avatar-2.jpg')}}" alt="Generic placeholder image">
                                            <div class="live-status bg-success"></div>
                                        </a>
                                        <div class="media-body">
                                            <div class="f-13 chat-header">Suzen</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar inner chat start-->
                <div class="showChat_inner">
                    <div class="media chat-inner-header">
                        <a class="back_chatBox">
                            <i class="feather icon-chevron-left"></i> Josephin Doe
                        </a>
                    </div>
                    <div class="media chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="estilo_painel/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                                <p class="chat-time">8:20 a.m.</p>
                            </div>
                        </div>
                    </div>
                    <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">
                            <div class="">
                                <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                                <p class="chat-time">8:20 a.m.</p>
                            </div>
                        </div>
                        <div class="media-right photo-table">
                            <a href="#!">
                                <img class="media-object img-radius img-radius m-t-5" src="estilo_painel/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                            </a>
                        </div>
                    </div>
                    <div class="chat-reply-box p-b-20">
                        <div class="right-icon-control">
                            <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                            <div class="form-icon">
                                <i class="feather icon-navigation"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar inner chat end-->
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">                   
                        @include('painel.template.Menu-Lateral')

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div  class="page-wrapper">
                                        
                                        <!-- HEADER PAGE-->
                                        <div class="page-header">
                                            <div class="row align-items-end">
                                                <div class="col-lg-8">
                                                    <div class="page-header-title">
                                                        <div class="d-inline">
                                                            <h4>{{$page_header or ""}}</h4>
                                                            <span>{{$descricao_page_header or ""}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="page-header-breadcrumb">
                                                        <ul class="breadcrumb-title">
                                                            <li class="breadcrumb-item">
                                                                <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                            </li>
                                                            <li class="breadcrumb-item"><a href="#!">Bootstrap Table</a>
                                                            </li>
                                                            <li class="breadcrumb-item"><a href="#!">Basic Table</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @yield('conteudo')

                                    </div>
                                </div>

                                <div id="styleSelector">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery/js/jquery.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/bower_components/modernizr/js/css-scrollbars.js')}}"></script>

    
    <!--amchart js -->
    <script src="{{asset('estilo_painel/assets/pages/widget/amchart/amcharts.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/pages/widget/amchart/light.js')}}"></script>
    <script src="{{asset('estilo_painel/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
   <!--  <script type="text/javascript" src="{{asset('estilo_painel/assets/js/SmoothScroll.js')}}"></script> -->
    <script src="{{asset('estilo_painel/assets/js/pcoded.min.js')}}"></script>
    <!--custom js -->
    <script src="{{asset('estilo_painel/assets/js/vartical-layout.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/dashboard/custom-dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/script.min.js')}}"></script>
     <!-- notification js -->
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/bootstrap-growl.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/notification/notification.js')}}"></script>
     <!-- Select2 js -->
    <script src="{{asset('estilo_painel/bower_components/select2-develop/dist/js/select2.full.js')}}" type="text/javascript"></script>
    

    <script src="{{asset('estilo_painel/bower_components/jquery-sweetalert2/js/sweetalert2.js')}}" type="text/javascript"></script>
   
    
    <script type="text/javascript" src="{{asset('estilo_painel/assets/js/mascaras.js')}}"></script> 
    
    
    <script type="text/javascript">
        $(document).ready(function () {
             _token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
            //Variavel do WOLI
            woli = "{{asset('imagens/woli.png')}}";
            woli_titulo="<h2 style='margin-top:auto;'>Woli</h2> <img src = '"+woli+"' width='100' height='70'>";
            
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_area-code').mask('(00) 0000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
            $('.money2').mask("#.##0,00", {reverse: true});
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                }
            });
            $('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {reverse: true});
            $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
            $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                        pattern: /[//]/,
                        fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
            });
            $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});

            
            $(document).on('input','.time',function(){                
                timerValidate($(this));                
            });
            $(document).on('focus','.time',function(){
                $('.time').mask('00:00');                
            });
            $(document).on('focus','.time',function(){
                $('.placa').mask('AAA-0A00');                
            });
            $(document).on('focus','.money2',function(){
                $('.money2').mask("#.##0,00", {reverse: true});
            })
            
            $(document).on('input','.phone_area-code',function(){
                phoneValidate($(this));
                
            });
            $(document).on('focus','.phone_area-code',function(){
                
                $('.phone_area-code').mask('(00) 0000-0000');
            });
            
            function phoneValidate(telefone){
                caracteres = telefone.val().length;
                if(caracteres>=5){
                    var x = telefone.val();
                   var y=x.substr(5,1);
                   console.log(y);
                    if(y==9){
                        //Montar Função para o telefone funcionar tanto com celular como fixo
                        $('.phone_area-code').mask('(00) 00000-0000');
                    }else{
                        $('.phone_area-code').mask('(00) 0000-0000');
                    }
                }
            }
            
            function timerValidate(horario){
               
                 caracteres=horario.val().length;
                 
            //alert(caracteres);
            if(caracteres==1){
                if(horario.val()>2){
                    horario.val(null);
                }
                
            }else if(caracteres==2){
                if(horario.val()>23){
                    horario.val(null);
                }
            }else if(caracteres==4){
                x=horario.val();
                y=x.substring(3,4);
             
                if(y>6){
                    horario.val(x.substring(0,3));
                }
            }else if(caracteres==5){
                x=horario.val();
                y=x.substring(3,5);
             
                if(y>59){
                    horario.val(x.substring(0,3));
                }
            }

            }
        });
        
    </script>
    <script>
        //MINHAS FUNÇÕES GLOBIAS
        number_format = function (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }
    </script>
    @yield('javascript')

</body>
</html>

