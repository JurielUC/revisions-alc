<?php
require_once "connectDB.php";

date_default_timezone_set("Asia/Manila");

if (isset($_POST['date']) && !empty($_POST['date'])) {
    // If a date is selected, fetch available times based on the selected date
    $selected_date = $_POST['date'];
    
    $selected_service = '';
    if (isset($_POST['service'])) {
        $selected_service = $_POST['service'];
    }

    // Updated query to exclude cancelled appointments
    $query = "SELECT datetime FROM appointments WHERE DATE(datetime) = ? AND service = ? AND status != 3";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ss", $selected_date, $selected_service);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $booked_times = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $time = date('H:i:s', strtotime($row['datetime']));
        $booked_times[] = $time;
    }

    $valid_times = [
        "09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00",
        "13:00:00", "13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00"
    ];

    // Get available times (those that are not booked or cancelled)
    $available_times = array_diff($valid_times, $booked_times);

    // Get current date and time
    $current_date = date('Y-m-d');
    $current_time = date('H:i:s');

    // Prepare HTML output
    $options_html = '<div class="mb-4">';
    $options_html .= '<p class="mb-3 font-weight-bold text-dark">Available Time Slots</p>';
    $options_html .= '<hr class="mb-4">';

    // Check if selected date is today
    $is_today = ($selected_date == $current_date);

    $options_html .= '<div class="row">';
    // Loop through all valid times and disable the ones that are booked or passed if today
    foreach ($valid_times as $time) {
        $formatted_time = date('h:i A', strtotime($time));

        // Disable times that are booked
        if (in_array($time, $booked_times)) {
            $options_html .= '<div class="col-md-4 mb-3">
                                <input style="cursor: not-allowed" type="button" class="text-gray form-control time-slot" value="' . $formatted_time . '" disabled readonly />
                              </div>';
        } else {
            // If the selected date is today, disable times earlier than the current time
            if ($is_today && $time <= $current_time) {
                $options_html .= '<div class="col-md-4 mb-3">
                                    <input style="cursor: not-allowed" type="button" class="text-gray form-control time-slot" value="' . $formatted_time . '" disabled readonly />
                                  </div>';
            } else {
                // If the time is available, show it as clickable
                $options_html .= '<div class="col-md-4 mb-3">
                                    <input type="button" class="form-control time-slot" value="' . $formatted_time . '" readonly />
                                  </div>';
            }
        }
    }

    $options_html .= '</div>';
    $options_html .= '</div>';
} else {
    // If no date is selected, show all times as disabled
    $valid_times = [
        "09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00",
        "13:00:00", "13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00"
    ];

    $options_html = '<div class="mb-4">';
    $options_html .= '<p class="mb-3 font-weight-bold text-dark">Pick a date to view available times.</p>';
    $options_html .= '<hr class="mb-4">';
    $options_html .= '<div class="row">';

    foreach ($valid_times as $time) {
        $formatted_time = date('h:i A', strtotime($time));
        // Disabled time slots
        $options_html .= '<div class="col-md-4 mb-3">
                            <input style="cursor: not-allowed" type="button" class="text-gray form-control time-slot" value="' . $formatted_time . '" disabled readonly />
                          </div>';
    }

    $options_html .= '</div>';
    $options_html .= '</div>';
}

echo $options_html;
?>
