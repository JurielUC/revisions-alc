<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?php if ($active == "home") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="user-home">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <li class="nav-item nav-category">Services</li>
        <li class="nav-item <?php if ($active == "services") {
                                echo "active";
                            } ?>">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="<?php if ($active == "services") {
                                                                                                echo "true";
                                                                                            } else {
                                                                                                echo "false";
                                                                                            } ?>" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
                <span class="menu-title">Services</span>
                <i class="menu-arrow mdi mdi-chevron-down"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="services?title=X-RAY">X-RAY</a></li>
                    <li class="nav-item"> <a class="nav-link" href="services?title=Laboratory">Laboratory</a></li>
                    <li class="nav-item"> <a class="nav-link" href="services?title=2d Echo">2D Echo</a></li>
                    <li class="nav-item"> <a class="nav-link" href="services?title=Ultrasound">Ultrasound</a></li>
                    <li class="nav-item"> <a class="nav-link" href="services?title=ECG">ECG</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Components</li>
        <li class="nav-item <?php if ($active == "appointment") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="user-appointment">
                <i class="menu-icon mdi mdi-file-document-outline"></i>
                <span class="menu-title">Appointment</span>
            </a>
        </li>
        <li class="nav-item <?php if ($active == "contacts") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="user-contacts">
                <i class="menu-icon mdi mdi-contact-mail-outline"></i>
                <span class="menu-title">Contacts</span>
            </a>
        </li>
        <li class="nav-item <?php if ($active == "about") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="user-about">
                <i class="menu-icon mdi mdi-comment-question-outline"></i>
                <span class="menu-title">About</span>
            </a>
        </li>
        <li class="nav-item d-lg-none d-block" style="cursor: pointer;">
            <a class="nav-link" data-toggle="modal" data-target="#logoutModal"><i class="menu-icon mdi mdi-power"></i><span class="menu-title">Sign Out</span></a>
        </li>
    </ul>
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
                <a href="user-logout" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>