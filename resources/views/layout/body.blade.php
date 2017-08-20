<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MindProject</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .floating{
            top: 30px;
            right: 50%;
            
            position: fixed;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div id="page">
        @include('layout.header')
        <div id="contents">
        @if (Session::has('flash_message'))
            <div class="alert alert-success floating">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('flash_message') }}
            </div>
            <script type="txt/javascript">
                setTimeout('document.getElementsByClassName("alert")[0].style.display="none"',2000)
            </script>

        @endif
        @yield('content')
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/mindproject/public/js/shortcut.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php 
        $isEditGantt = (strpos($_SERVER["REQUEST_URI"],'gantt'));
        if($isEditGantt){            
            #echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
            #echo '<script src="/mindproject/public/js/shortcut.js"></script>';
            #echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
            echo '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/jquery.livequery.1.1.1.min.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/jquery.timers.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/utilities.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/forms.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/date.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/dialogs.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/layout.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/i18nJs.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/dateField/jquery.dateField.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/JST/jquery.JST.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/svg/jquery.svg.min.js"></script>';
            echo '<script src="/mindproject/public/js/ganttlibs/jquery/svg/jquery.svgdom.1.8.js"></script>';
            echo '<script src="/mindproject/public/js/ganttUtilities.js"></script>';
            echo '<script src="/mindproject/public/js/ganttTask.js"></script>';
            echo '<script src="/mindproject/public/js/ganttDrawerSVG.js"></script>';
            echo '<script src="/mindproject/public/js/ganttGridEditor.js"></script>';
            echo '<script src="/mindproject/public/js/ganttMaster.js"></script>';
            echo '<script src="/mindproject/public/js/gantt.js"></script>';
            
            
            #echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
        }
        $isEditMM = (strpos($_SERVER["REQUEST_URI"],'mindmap'));
        if($isEditMM){
            #echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';

            echo '<script type="text/javascript" src="/mindproject/public/js/jsmind.min.js"></script>';
            echo '<script type="text/javascript" src="/mindproject/public/js/jsmind.draggable.js"></script>';
            #echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
            #echo '<script src="/mindproject/public/js/shortcut.js"></script>';
            #echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
            echo '<script type="text/javascript" src="/mindproject/public/js/mindmap.js"></script>';
        }
        if(!$isEditGantt && !$isEditMM){
            #echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
            #echo '<script src="/mindproject/public/js/shortcut.js"></script>';
            #echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
            #echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';            
            #echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>';
            echo '<script src="/mindproject/public/js/bootstrap-tooltip.js"></script>';
            #echo '<script type="text/javascript>!function ($) {function(){$(\'[data-toggle="confirmation"]\').confirmation();})}(window.jQuery);</script>';            
            echo '<script src="/mindproject/public/js/index.js"></script>';
            echo '<script src="/mindproject/public/js/bootstrap-confirmation.min.js"></script>';
            #echo '<script type="text/javascript>';
        }
    ?>

</body>
</html>


