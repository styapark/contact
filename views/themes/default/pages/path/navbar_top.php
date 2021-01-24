
<!--Navbar-->
<header class="navbar navbar-expand-lg fixed-top">
    <!-- Collapse button -->
    <button class="navbar-toggler waves-light" type="button" data-toggle="collapse" data-target="#sidebar">
        <span class="navbar-toggler-icon">
            <i class="zmdi zmdi-menu"></i>
        </span>
    </button>
    <!-- Navbar brand -->
    <a class="navbar-brand waves-light" href="#"><?= $title ?></a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="zmdi zmdi-email"></i>
            </a>
        </li>
        <li class="nav-item notifications">
            <a class="nav-link" href="#">
                <i class="zmdi zmdi-notifications"></i>
            </a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="zmdi zmdi-more-vert"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-item themes">
                    Themes
                    <div class="btn-group-sm">
                        <button type="button" class="btn btn-dark-green"></button>
                        <button type="button" class="btn btn-default"></button>
                        <button type="button" class="btn btn-info"></button>
                        <button type="button" class="btn btn-primary"></button>
                        <div class="clear-fix"></div>
                        <button type="button" class="btn btn-indigo"></button>
                        <button type="button" class="btn btn-secondary"></button>
                        <button type="button" class="btn btn-pink"></button>
                        <button type="button" class="btn btn-danger"></button>
                        <div class="clear-fix"></div>
                        <button type="button" class="btn btn-deep-orange"></button>
                        <button type="button" class="btn btn-amber"></button>
                        <button type="button" class="btn btn-elegant"></button>
                        <button type="button" class="btn btn-mdb-color"></button>
                        <div class="clear-fix"></div>
                        <button type="button" class="btn btn-dark-mood"></button>
                    </div>
                </div>
                <form class="dropdown-item" method="GET">
                    Tahun Anggaran
<?php
$range_years = [];
for($y=(date('Y')+2);$y>=(date('Y')-28);$y--) {
    $range_years[$y] = $y;
}
?>
<?= form_dropdown('year', $range_years, !empty($_SESSION['year']) ? $_SESSION['year']: date('Y'), ' class="form-control md" onchange="this.form.submit()"') ?>
                </form>
                <div class="dropdown-item toggle md">
                    <input type="checkbox" class="toggle-input" id="switch" /><label class="toggle-label" for="switch">Toggle</label>
                </div>
            </div>
        </li>
    </ul>
</header>
<!--/.Navbar-->