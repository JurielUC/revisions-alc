<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="admin-home">
                <img src="assets/img/logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="admin-home">
                <img src="assets/img/logo.png" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Welcome, <span class="text-black fw-bold"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></span></h1>
                <h3 class="welcome-sub-text">Accuracy Laboratory Corporation</h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="storage/<?php if ($row["photo"] != "") {
                                                                        echo $row["photo"];
                                                                    } else {
                                                                        echo 'default_image.png';
                                                                    } ?>" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="storage/<?php if ($row["photo"] != "") {
                                                                            echo $row["photo"];
                                                                        } else {
                                                                            echo 'default_image.png';
                                                                        } ?>" width="60" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                        <p class="fw-light text-muted mb-0"><?php echo $row['email']; ?></p>
                    </div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Signing Out?</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to sign out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="admin-logout" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>