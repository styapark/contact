
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
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="zmdi zmdi-more-vert"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-item themes">
                    Themes
                    <div class="btn-group-sm">
                        <button type="button" class="btn btn-elegant">Light</button>
                        <div class="clear-fix"></div>
                        <button type="button" class="btn btn-dark-mood">Dark Mode</button>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</header>
<!--/.Navbar-->