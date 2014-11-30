<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../js/jquery-ui/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-ui/js/jquery-1.9.0.js" type="text/javascript"></script>
        <link href="../js/bootstrap/themes/bootstrap_cerulean.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#content').load("testGrid.php");
            });
        </script>
    </head>
    <body>
        <div class="navbar navbar-default" style="margin-bottom: 10px;">
            <div class="navbar-header" style="float: right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">الرئيسية</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse" style="padding-right:17px;padding-left: 17px;">
                <ul class="nav navbar-nav">
                    <li><a href="#">خروج</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">خيارات <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="direction: rtl;">
                            <li><a href="#">الملف الشخصي</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Dropdown header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action1</a></li>

                                <li><a href="#">Another action1</a></li>
                                <li><a href="#">Something else here1</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <div id="menu" style="width: 100% ; height: 50px;direction: rtl;">
            <div class="btn-group" style="margin-right:10px;">
                <button type="button" class="btn btn-default">Left</button>
                <button type="button" class="btn btn-default">Middle</button>
                <button type="button" class="btn btn-default">Right</button>
            </div>
        </div>
        <div id="rightPanel" style="width:280px;float: right;direction:rtl;margin-right: 10px;">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a style="text-align: right;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                التحكيم
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked" style="padding-right: 0px;">
                                <li class="default">
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li class="default">
                                    <a href="#">
                                        Options
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a style="text-align: right;" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                خيارات
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked" style="padding-right: 0px;">
                                <li class="default">
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li class="default">
                                    <a href="#">
                                        Options
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                More Links
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked" style="padding-right: 0px;">
                                <li class="default">
                                    <a href="#">
                                        Link
                                    </a>
                                </li>
                                <li class="default">
                                    <a href="#">
                                        Link
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" style="width:90%;float:right;margin-right: 20px;direction: rtl;margin-bottom: 30px;background-color: green;">

        </div>


    </body>
</html>
