        <?php $user = Auth::user() ?>
        <header id="header">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
			            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
			            </button>
			            <a class="navbar-brand" href="">MindProject</a>
		            </div>
                    <div class="collapse navbar-collapse" id="navbarEexample">
                        <ul class="nav navbar-nav">
                            @if(Auth::check())
                                  <li><a href="{{ url('home') }}">Dashboard</a></li>
                            @endif
                            @if(Auth::guest())
                                  <li><a href="{{ url('login') }}">Login</a></li>
                            @endif
                            @if(Auth::guest())
                                  <li><a href="{{ url('register') }}">Sign Up</a></li>
                            @endif
                            
                        </ul>
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    Menu 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::check())
                                        <form method="post" id="form_logout" action="logout">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </form>    
                                        <li><a href="javascript:document.getElementById('form_logout').submit();">Logout</a></li>
                                        <!--<li><a href="{{ url('auth/logout') }}">Logout</a></li>-->
                                    @endif
                                    @if(Auth::check())
                                        <li><a href="{{url('home')}}">{{ $user['email'] }}</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                        
                    </div>
                    <!--<a class="navbar-brand" id="logo" href="{{ url('home') }}">
                        MindProject
                    </a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right ">
                            @if(Auth::check())
                                  <li><a href="{{ url('home') }}">Dashboard</a></li>
                            @endif
                            @if(Auth::guest())
                                  <li><a href="{{ url('auth/login') }}">Login</a></li>
                            @endif
                            @if(Auth::guest())
                                  <li><a href="{{ url('auth/register') }}">Sign Up</a></li>
                            @endif
                            @if(Auth::check())
                                  <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                            @endif
                            @if(Auth::check())
                                  <li><a href="{{url('home')}}">{{ $user['email'] }}</a></li>
                            @endif
                        </ul>
                    </div>
                    -->
                </div>
            </nav>
            <!--
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
            </div>-->
            <link type="text/css" rel="stylesheet" href="/mindproject/public/css/jsmind.css" />
           
            <link rel=stylesheet href="/mindproject/public/css/platform.css" type="text/css">
            <link rel=stylesheet href="/mindproject/public/css/jquery.dateField.css" type="text/css">
            <link rel=stylesheet href="/mindproject/public/css/gantt.css" type="text/css">
            <link rel=stylesheet href="/mindproject/public/css/ganttPrint.css" type="text/css" media="print">
            <link rel=stylesheet href="/mindproject/public/css/ganttstyle.css" type="text/css">
        </header><!-- #header -->