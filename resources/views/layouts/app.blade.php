<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>pgBouncerHud @yield('title')</title>

<!-- <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
--!>

    @yield('page-script')

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="//fonts.googleapis.com/css?family=Oswald:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'-->
    <link rel="stylesheet" href="/fonts/awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/mystyle.css">
    <!-- <link rel="stylesheet" href="css/bootstrap-social-gh-pages/bootstrap-social.css"> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.superhero.min.css">
    <link rel="stylesheet" href="/css/loading-bar.css">

    <!-- Footer Styles -->
    <link rel="stylesheet" href="/css/footer.css">

    @yield('page-style')

    <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-family: 'Lato', "Source Sans Pro", sans-serif;
                font-size: 20px;
            }

            #map-wrap {
               top: 0;
               bottom:0;
               /* position:fixed; */
               overflow-y:scroll;
               overflow-x:hidden;
            }

            .container {
                text-align: left;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .fa-btn {
            margin-right: 6px;
            }
            .article-img {
               display: inline-block;
               /* vertical-align: middle; */
               margin-left: 5%;
               margin-bottom: 2%;
               width: 90%;
               height: 300px;
            }
            .article-img img{
               border: 1px dashed transparent;
               border-color: #e7e7e7;
               width: 100%;
               height: 100%;
            }
            .navbar {
               min-height: 55px;
            }
            .navbar>.container-fluid {
               display: inline-block;
            }
            .navbar-header {
               float: left;
               font-family: 'Oswald';
            }
            .navbar-default .navbar-nav>li>a {
                color: #158CBA;
            }

            .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
                color: white;
                cursor: pointer;
            }

            .btn-toolbar  {
                display: inline;
            }

            .panel-heading {
               font-family: 'Oswald';
               font-size: 26px;
            }

            #footerLogo {margin-bottom: 22px;}
            #footerRights {padding-top:22px;padding-bottom:22px;margin-top:22px; text-align: center; font-size:10px;}
            .footerWidget {margin-bottom: 22px}

            footer {
               padding:44px 0 0 0;
               color: #777;
               background: #f8f8f8;
               border-top: 1px solid transparent;
               border-color: #e7e7e7;
            }

            /* footer 1 */
            .worksList li{display:inline-block; margin: 0 10px 10px 0;}

            /* footer 4 */
            .footer4 #footerRights {text-align: left; background:#e7e7e7;}
            .bigTitle.bigTitleFooter {font-size: 2em; margin-bottom: 0;}

            #footerRights {
               background-color: #f8f8f8;
               color: #999;
               border-top: 1px solid #e7e7e7;
               padding-top: 22px;
               padding-bottom: 22px;
               margin-top: 22px;
               text-align: center;
               font-size: 10px;
               display: block;
               font-family: 'Lato';
            }

            .navbar {
               min-height: 55px;
            }
            .navbar-header {
               float: left;
               padding: 5px;
               font-family: 'Oswald';
            }
            .navbar-header > a.active{
               font-weight:bold;
               font-size: 34px;
               color: white !important;
            }

            .navbar-default {
               /*font: normal 36px 'Cookie', cursive;*/
               font: normal 16px sans-serif;
               text-decoration: none;
               background-color: #292c2f;
            }

            .navbar-brand {
               color: #efe3e3 !important;
               font-family: 'Oswald';
               font-size: 32px;
               -o-object-fit: contain;
               object-fit: contain;
            }

            .navbar>.container-fluid .navbar-brand {
                margin-left: -5px;
            }

            .vim {
               display: inline-block;
               font: normal normal normal 14px/1 FontAwesome;
               font-size: inherit;
               text-rendering: auto;
               -webkit-font-smoothing: antialiased;
               -moz-osx-font-smoothing: grayscale;
               height: 100%;
            }
               /* background-color: transparent; */

            @media(min-width:992px){
               /* footer 4 */
               .footer4 #footerRights .quickMenu {float:right;}
               /* footer 5 */
               .footer5 #footerRights p{float: left;}
               .footer5 #footerRights .socialNetwork{float: right;}
            }
    </style>
</head>

<!-- <a class="navbar-brand{{ (Request::is('console') ? ' active' : '')}}" href="{{ url('/console') }}"> Console </a> -->

@yield('bodydef')
    <!-- <nav class="navbar navbar-default"> -->
    <div class="navbar navbar-default" role="navigation" data-ng-controller="HomeController">
        <div class="container-fluid">
        <div class="navbar-header">
            {!! Html::image('img/pgbouncerhud.png', 'pgbouncerhud logo',  array('class' => 'navbar-left img-responsive pull-left')) !!}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <a class="navbar-brand{{ (Request::is('console') ? ' active' : '')}}" href="{{ url('/console') }}#/"> Console </a>
        <a class="navbar-brand{{ (Request::is('about') ? ' active' : '')}}" href="{{ url('/about') }}#/"> About </a>
        </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
<!-- 
                    <li data-ng-show="token"><a ng-href="#/restricted">Restricted area</a></li>
-->
                    <li data-ng-hide="token"><a ng-href="#/signin">Log in</a></li>
                    <li data-ng-hide="token"><a ng-href="#/signup">Sign up</a></li>
                    <li data-ng-show="token"><a ng-click="logout()">Logout</a></li>
                </ul>
            </div>
        </div>
<!--    </nav> -->
    </div>

    {{-- !! Request::Path() !! --}}

    @yield('content')

		<footer class="footer-distributed">

			<div class="footer-left">

				<h3>pgBouncerHud <span>by glenn</span></h3>

				<p class="footer-links">
					<a href="{{ url('/console') }}">Console</a>
					·
					<a href="{{ url('/about') }}">About</a>
				</p>

				<p class="footer-company-name">Bitless.be&copy; 2017</p>
			</div>

			<div class="footer-center">
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:info@bitless.be">info@bitless.be</a></p>
				</div>
			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About the software</span>
				    This is used to get an overview of many pgbouncers , find pgbouncerhud on github !
				</p>
			</div>
		</footer>
    <!-- JavaScripts -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-route.min.js"></script>
    <script src="/js/loading-bar.js"></script>
    <!-- Token storage -->
    <script src="//cdn.jsdelivr.net/ngstorage/0.3.11/ngStorage.min.js"></script>
    @yield('page-bottom-script')
</body>
</html>
