<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MindProject</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="page">
        @include('layout.header')
        <div id="contents">
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
            {{ Session::get('flash_message') }}
            </div>
        @endif
        @yield('content')
        </div>
    </div>
    <?php 
        $isEditGantt = (strpos($_SERVER["REQUEST_URI"],'editga'));
        if(!$isEditGantt){
            echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
        }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


