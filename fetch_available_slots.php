<?php
require_once "connectDB.php";

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

    // Prepare HTML output
    $options_html = '<div class="mb-4">';
    $options_html .= '<p class="mb-3 font-weight-bold">Available Time Slots</p>';
    $options_html .= '<hr class="mb-4">';
    $options_html .= '<div class="row">';

    // Loop through all valid times and disable the ones that are booked
    foreach ($valid_times as $time) {
        $formatted_time = date('h:i A', strtotime($time));

        if (in_array($time, $booked_times)) {
            // If the time is booked, disable the button
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

    $options_html .= '</div>';
    $options_html .= '</div>';
} else {
    // If no date is selected, show all times as disabled
    $valid_times = [
        "09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00",
        "13:00:00", "13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00"
    ];

    $options_html = '<div class="mb-4">';
    $options_html .= '<p class="mb-3 font-weight-bold">Pick a date to view available times.</p>';
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
