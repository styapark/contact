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
        <meta name="geo.region" content="ID-JI" />
        <meta name="geo.placename" content="KANTOR INSPEKTORAT BAPPEDA TRENGGALEK" />
        <meta name="geo.position" content="-8.05056;111.70823" />
        <meta name="ICBM" content="-8.05056, 111.70823" />
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="robots" content="noindex,nofollow"/>
        <meta name="description" content="Web Application with MyLite cms concept"/>
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
        <script src="media/js/<?= md5('parsley.min.js') ?>"></script>
        <script src="media/js/i18n/id.js"></script>
        <script src="media/js/i18n/id.extra.js"></script>
        <script src="media/js/<?= md5('global.validation.js') ?>"></script>
        <script src="media/js/app.js"></script>
        <script src="media/js/shim.min.js"></script>
        <script src="media/js/<?= md5('Chart.bundle.min.js') ?>"></script>
        <script src="media/js/xlsx.full.min.js"></script>
<?php if ($print) { ?>
<!--        <script type="text/javascript">
            window.onload = function() {
                $('.preloader-cycle').remove();
                window.print();
            };
        </script>-->
        <style type="text/css" >
            body {
                color: #222 !important;
                font-size: 13px !important;
                background-color: #fff;
            }
            .navbar, #sidebar, .content-body .breadcrumb {
                display: none !important;
            }
            .content-body {
                margin-left: 0 !important;
                margin-top: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }
            .content-body > .row > .col-12 > .card {
                width: fit-content;
            }
            .content-body .h3 {
                font-size: 1.3rem
            }
            .content-body .h4 {
                font-size: 1.2rem
            }
            .content-body .h5 {
                font-size: 1.1rem
            }
            .content-body .h3, .content-body .h4, .content-body .h5 {
                margin-bottom: 0.2rem;
            }
            .content-body .table {
                width: 100% !important;
            }
            .content-body .table ol {
                padding-inline-start: 20px;
            }
            .content-body .table ul {
                padding-left: 0;
                list-style: none;
            }
            .content-body .table, .content-body .table th, .content-body .table td  {
                border: 1px solid #333 !important;
                font-size: 13px !important;
            }
            .content-body .table th, .content-body .table td {
                padding: 0.3rem;
            }
            .content-body .table th {
                vertical-align: middle !important;
            }
            @media print {
                .content-body .table .green.lighten-4 > td {
                    background: #c8e6c9 !important;
                }
                .content-body .table .amber.lighten-4 > td {
                    background: #ffecb3 !important;
                }
            }
            @page {
                size: A3 landscape;
            }
        </style>
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