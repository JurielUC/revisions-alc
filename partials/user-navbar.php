<?php
require_once "connectDB.php";

$unread_count = 0;

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // if ($_SERVER['REQUEST_URI'] === '/user-home' || $_SERVER['REQUEST_URI'] === '/alc/user-home') {
    //     $sql_reset_unread = "UPDATE appointments SET unread = 1 WHERE user_id = '" . $_SESSION['id'] . "' AND status IN (1, 2)";
    //     mysqli_query($link, $sql_reset_unread);
    // }

    $sql_nav = "SELECT COUNT(*) as unread_count 
            FROM appointments 
            WHERE user_id = '" . $_SESSION['id'] . "' 
            AND unread = 0 
            AND status IN (1, 2)";

    $result_nav = mysqli_query($link, $sql_nav);
    if ($result_nav && $row_nav = mysqli_fetch_assoc($result_nav)) {
        $unread_count = $row_nav['unread_count'];
    }
} else {
    header("location: login");
    exit;
}
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?php if ($active == "home") {
                                echo "active";
                            } ?>">
            <a class="nav-link home-nav" href="user-home">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title d-flex">
                    Home
                    <div class="mx-2" style="width: 15px; height: 15px; background-color: red; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white;">
                        <span style="font-size: 10px;">
                            <?php echo $unread_count; ?>
                        </span>
                    </div>
                </span>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homeNavLink = document.querySelector('.home-nav'); 
        
        homeNavLink.addEventListener('click', function (e) {
            e.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('GET', './update_unread.php', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (xhr.responseText === 'success') {
                        window.location.href="user-home"
                    } else {
                        alert('Failed to mark appointments as read: ' + xhr.responseText);
                    }
                } else {
                    alert('Request failed with status ' + xhr.status);
                }
            };
            xhr.onerror = function () {
                console.error('Request failed');
                alert('Request failed, please try again');
            };
            xhr.send();
        });
    });
</script>