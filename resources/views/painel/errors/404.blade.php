﻿<!DOCTYPE html>

<html lang="pt-br" class="no-js">

	<head>
		<meta charset="utf-8">
		<title>Woli - Erro</title>
		<meta name="description" content="Flat able 404 Error page design">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Codedthemes">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('estilo_painel/extra-pages/404/1/img/favicon.ico')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('estilo_painel/extra-pages/404/1/css/style.css')}}">
	</head>

	<body>

        <div class="image"></div>

        <!-- Your logo on the top left -->
        <a href="#" class="logo-link" title="back home">

            <img src="{{asset('estilo_painel/extra-pages/404/1/img/logo.png')}}" class="logo" alt="Company's logo">

        </a>

        <div class="content">

            <div class="content-box">

                <div class="big-content">

                    <!-- Main squares for the content logo in the background -->
                    <div class="list-square">
                        <span class="square"></span>
                        <span class="square"></span>
                        <span class="square"></span>
                    </div>

                    <!-- Main lines for the content logo in the background -->
                    <div class="list-line">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>

                    <!-- The animated searching tool -->
                    <i class="fa fa-search" aria-hidden="true"></i>

                    <!-- div clearing the float -->
                    <div class="clear"></div>

                </div>

                <!-- Your text -->
                <h1>Oops! Erro 404 pagina não encotrada.</h1>

                <p>A pagina que você está procurando não existe.<br>
                    Clique aqui para a <a href="{{route('dashboard')}}">Pagina Inicial.</p>

            </div>

        </div>

        <footer class="light">

            <ul>
                <li><a href="{{route('dashboard')}}">Home</a></li>

                <li><a href="#">Reportar Erro</a></li>
<!--
                <li><a href="#">Help</a></li>

                <li><a href="#">Trust & Safety</a></li>

                <li><a href="#">Sitemap</a></li>-->

                <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            </ul>

        </footer>
        <script src="{{asset('estilo_painel/extra-pages/404/1/js/jquery.min.js')}}"></script>
        <script src="{{asset('estilo_painel/extra-pages/404/1/js/bootstrap.min.js')}}"></script>

    </body>

</html>