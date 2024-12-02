<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Menu Category -->
        <li class="nav-item nav-category">Menu</li>

        <!-- Dashboard -->
        <li class="nav-item <?php if ($active == "dashboard") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="admin-dashboard">
                <i class="menu-icon mdi mdi-view-dashboard"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Patient Flow -->
        <li class="nav-item <?php if ($active == "patientflow") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="admin-patient-flow">
                <i class="menu-icon mdi mdi-account-arrow-right"></i>
                <span class="menu-title">Patient Flow</span>
            </a>
        </li>

        <!-- Patient Records -->
        <li class="nav-item <?php if ($active == "patientrecords") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="admin-patient-records">
                <i class="menu-icon mdi mdi-folder-account"></i>
                <span class="menu-title">Patient Records</span>
            </a>
        </li>

        <!-- Report Category -->
        <li class="nav-item nav-category">Report</li>

        <!-- Inventory -->
        <li class="nav-item <?php if ($active == "inventory") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="admin-inventory">
                <i class="menu-icon mdi mdi-clipboard"></i>
                <span class="menu-title">Inventory</span>
            </a>
        </li>

        <!-- Machine -->
        <li class="nav-item <?php if ($active == "machine") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="admin-machine">
                <i class="menu-icon mdi mdi-cogs"></i>
                <span class="menu-title">Machine</span>
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
                <a href="staff-logout" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>