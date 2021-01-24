<!DOCTYPE html>
<html ng-app="greenprojectid">
    <head>
        <script>
            <!--//--><![CDATA[//><!--
            function setCookie(cn,cv, x = 1) {var d= new Date();d.setTime(d.getTime()+(x*24*60*60*1000));document.cookie=cn+"="+cv+";expires="+d.toUTCString()+";path=/";}function deleteCookie(cn) {document.cookie=cn+"=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";}function getCookie(cn) {var n=cn+"=";var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' '){c=c.substring(1);}if(c.indexOf(n)==0){return c.substring(n.length,c.length);}}return "";}function checkCookie(cn) {var u=getCookie(cn);return u!="" && u!=null;}

            var root = '<?= MyLite_base ?>';
            var skin = 'themes';
            //--><!]]>
        </script>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="robots" content="index,follow"/>
        <meta name="description" content=""/>
        <title><?= $title ?></title>
        <base href="<?= MyLite_base ?>"/>
        <link rel="icon" href="media/images/icon/pa.png">
        <link rel="stylesheet" href="media/css/bootstrap.css"/>
        <link rel="stylesheet" href="media/css/mdb.css"/>
        <link rel="stylesheet" href="media/css/<?= md5('dataTables.bootstrap4.min.css') ?>"/>
        <link rel="stylesheet" href="media/css/simple-scrollbar.css"/>
        <link rel="stylesheet" href="media/css/material-design-iconic-font.css"/>
        <link rel="stylesheet" href="media/css/<?= md5('snarl.css') ?>"/>
        <link rel="stylesheet" href="media/css/multi-select.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="media/css/style.css?_=<?= time() ?>"/>
        <script src="media/js/d958c283e70811506bbc470025689935"></script>
        <script src="media/js/<?= md5('angular.min.js') ?>"></script>
        <script src="media/js/app.js"></script>
        <script src="media/js/shim.min.js"></script>
        <script src="media/js/<?= md5('Chart.bundle.min.js') ?>"></script>
        <script src="media/js/xlsx.full.min.js"></script>
        <!--<script src="media/js/jspdf.min.js"></script>-->
<?php if ($print) { ?>
<!--        <script type="text/javascript">
            window.onload = function() {
                $('.preloader-cycle').remove();
                window.print();
            };
        </script>-->
<?php } ?>
    </head>
    <body>
        <?php if ($preloader) { ?>
        <div class="preloader-cycle">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
        <?php } ?>
        <div class="container-fluid">