<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $heading; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex, nofollow">
        <!-- Base URL -->
        <base href="<?= MyLite_base; ?>" crossorigin="anonymous">
        <!-- Bootstrap core CSS -->
        <link href="media/css/bootstrap.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="media/css/mdb.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="media/css/font-awesome.css" rel="stylesheet">
        <!-- Custom styles -->
        <link href="media/css/style.css" rel="stylesheet">
        <link rel="icon" href="media/images/icon/404.png">
        <style>
            a.btn:hover { color: inherit !important; }
        </style>
    </head>
    <body class="container-fluid">
        <div class="card col-sm-11 col-md-9 col-lg-6 mx-auto mb-3 grey-text" style="margin-top: 4rem;">
            <div class="card-body text-center">
                <h2 class="h2-responsive mb-3"><?= $heading; ?></h2>
                <img class="img-fluid" style="max-height: 250px; opacity: 0.5" src="media/images/icon/404.png"/>
                <span class="h4-responsive"><?= $message; ?></span>
                <a onclick="window.history.back()" class="btn btn-outline-grey">Back</a>
            </div>
        </div>
    </body>
</html>