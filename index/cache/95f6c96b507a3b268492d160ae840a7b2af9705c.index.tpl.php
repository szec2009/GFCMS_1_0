<?php
/* Smarty version 3.1.32-dev-38, created on 2018-03-31 12:04:52
  from '/home/devwherear/public_html/arms/index/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-38',
  'unifunc' => 'content_5abf79649bbda7_94108943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c82280c018461f4caa1428a9bca1b77eeaa73bc4' => 
    array (
      0 => '/home/devwherear/public_html/arms/index/index.tpl',
      1 => 1520065760,
      2 => 'file',
    ),
    '6d4cf5fae7180fabc28d1a0d31f6091d5ad0eca4' => 
    array (
      0 => '/home/devwherear/public_html/arms/libs/templates/header.tpl',
      1 => 1522254237,
      2 => 'file',
    ),
    'f5bab0fab8e79832adb9563ad54bca0555f99d9a' => 
    array (
      0 => '/home/devwherear/public_html/arms/libs/templates/footer.tpl',
      1 => 1519832512,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5abf79649bbda7_94108943 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="http://devwherear.com/arms/libs/js/popper.min.js"></script>
    <script src="http://devwherear.com/arms/libs/js/dropzone.js"></script>
    <script src="http://devwherear.com/arms/libs/js/jquery-3.1.1.min.js"></script>
    <script src="http://devwherear.com/arms/libs/js/bootstrap.js"></script>
    <script src="http://devwherear.com/arms/libs/js/bootstrap-toggle.js"></script>
    <script src="http://devwherear.com/arms/libs/js/bootstrap-select.js"></script>

    <script src="http://devwherear.com/arms/libs/js/function.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <!-- fancybox -->
    <script src="http://devwherear.com/arms/libs/js/fancybox/jquery.fancybox.js" ></script>


    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/bootstrap-grid.css"/>
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/bootstrap-reboot.css"/>
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/chartjs.css"/>
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/jqstooltip.css"/>
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/dropzone.css">
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/images/iconic/font/css/open-iconic-foundation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" text="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />

    <!-- fancybox -->
    <link rel="stylesheet" type="text/css" href="http://devwherear.com/arms/libs/css/fancybox/jquery.fancybox.css">


</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/arms/index/">Home</a>
    <a href="/arms/artarget/">AR Target</a>
    <a href="#">User Profile</a>
</div>

<div id="main">

    <div class="wherearheader">

        <div class="col-xl-12 col-md-12 row noMargin noPadding">

            <div class="col-xl-1 col-md-1 noMargin">
                <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
            <div class="col-xl-11 col-md-11 noMargin">
                <div class="col-xl-12 col-md-12 text-right row">
                    <div class="col-xl-11 col-md-11">
                        <button class="btn btn-primary">
                            + Credit
                        </button>
                        <span style="font-size: 20px; margin-left: 10px; margin-top: 10px;">
                            99,999.99
                        </span>
                    </div>
                    <div class="col-xl-1 col-md-1 text-right">
                        Username
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="wherearmain">

<div class="col-md-12 col-lg-12">


</div>

</div>

</div>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
    }
</script>

</body>
</html><?php }
}
