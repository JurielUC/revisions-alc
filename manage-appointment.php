<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="manage-appointment-<?php echo $row1['appointment_id']; ?>">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Appointment ID #<?php 
                        echo strlen($row1['appointment_id']) > 1 
                            ? "AP0" . $row1['appointment_id'] 
                            : "API00" . $row1['appointment_id'];
                    ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card shadow mb-3">
                                <div class="card-header">
                                    <strong class="card-title">Manage Appointment</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="hidden" name="appointment_id" value="<?php echo $row1['appointment_id']; ?>">
                                                <input type="hidden" name="user_email" value="<?php echo $row3['email']; ?>">
                                                <input type="hidden" name="username"
                                                    value="<?php echo $row3['first_name']; ?> <?php echo $row3['last_name']; ?>">
                                                <label for="example-status">Status</label>
                                                <select name="status" id="status-select-<?php echo $row1['appointment_id']; ?>" required
                                                    style="font-size: 14px;" class="form-select select <?php echo (!empty($status_err)) ? 'is-invalid' : 'custom-form-border'; ?>">
                                                    <option value="">Please select a status:</option>
                                                    <optgroup label="Status:">
                                                        <option value="1" <?php if ($row1['status'] == 1) echo 'selected'; ?>>Approved</option>
                                                        <option value="2" <?php if ($row1['status'] == 2) echo 'selected'; ?>>Rejected</option>
                                                    </optgroup>
                                                </select>
                                                <span class="invalid-feedback"><?php echo $status_err; ?></span>
                                            </div>

                                            <!-- Textarea for Rejection Reason -->
                                            <div class="form-group mb-3" id="rejection-reason-<?php echo $row1['appointment_id']; ?>" style="display: none;">
                                                <label for="rejection-reason-text">Reason for Rejection</label>
                                                <textarea name="rejection_reason" style="min-height: 100px; font-size: 14px;" id="rejection-reason-text-<?php echo $row1['appointment_id']; ?>" rows="4" style=""
                                                    class="form-control <?php echo (!empty($reason_err)) ? 'is-invalid' : 'custom-form-border'; ?>"
                                                    placeholder="Please provide the reason for rejection"></textarea>
                                                <span class="invalid-feedback"><?php echo $reason_err; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary" type="submit" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle the visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const appointmentId = "<?php echo $row1['appointment_id']; ?>";
        const statusSelect = document.getElementById(`status-select-${appointmentId}`);
        const rejectionReason = document.getElementById(`rejection-reason-${appointmentId}`);

        // Show or hide the textarea based on the selected status
        statusSelect.addEventListener('change', function () {
            if (this.value == 2) {
                rejectionReason.style.display = 'block';
            } else {
                rejectionReason.style.display = 'none';
            }
        });

        // Initialize visibility based on the pre-selected value
        if (statusSelect.value == 2) {
            rejectionReason.style.display = 'block';
        }
    });
</script>
