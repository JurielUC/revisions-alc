<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Menu</li>

        <!-- Appointment List -->
        <li class="nav-item <?php if ($active == "appointmentlist") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="staff-appointment-list">
                <i class="menu-icon mdi mdi-calendar-check"></i>
                <span class="menu-title">Appointment List</span>
            </a>
        </li>

        <!-- Patient Result -->
        <li class="nav-item <?php if ($active == "patientresult") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="staff-input-patient-result">
                <i class="menu-icon mdi mdi-file-document-edit"></i>
                <span class="menu-title">Patient Result</span>
            </a>
        </li>

        <!-- Patient Records -->
        <li class="nav-item <?php if ($active == "patientrecords") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="staff-patient-records">
                <i class="menu-icon mdi mdi-folder-account"></i>
                <span class="menu-title">Patient Records</span>
            </a>
        </li>

        <!-- Inventory -->
        <li class="nav-item <?php if ($active == "inventory") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="staff-inventory">
                <i class="menu-icon mdi mdi-clipboard"></i>
                <span class="menu-title">Inventory</span>
            </a>
        </li>

        <!-- Machine -->
        <li class="nav-item <?php if ($active == "machine") {
                                echo "active";
                            } ?>">
            <a class="nav-link" href="staff-machine">
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