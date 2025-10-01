<?php
session_start();

// ✅ Make sure invite is still present
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$invite = $_SESSION['invite'];

// Store RSVP choices in session
$_SESSION['rsvp_attendance'] = $_POST['Attendance_Group'] ?? '';
$_SESSION['group_id'] = $invite['Group_ID'] ?? null;

// Reject non-POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

// Helper function to trim and sanitise strings
function clean_input($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Extract and clean inputs
$invite_id = clean_input($_POST['Invite_ID'] ?? '');
$login_code = clean_input($_POST['Login_Code'] ?? '');
$attendance_group = clean_input($_POST['Attendance_Group'] ?? '');
$individual_attendance = isset($_POST['Individual_Attendance']) ? $_POST['Individual_Attendance'] : [];
$dietary_requirements = clean_input($_POST['Dietary_Requirements'] ?? '');
$staying_onsite = clean_input($_POST['Staying_Onsite'] ?? '');
$friday_dinner = clean_input($_POST['Friday_Dinner'] ?? '');
$final_notes = clean_input($_POST['Final_Notes'] ?? '');
$timestamp = date('Y-m-d H:i:s');

// ✳️ Server-side validation logic
$errors = [];

// 1. Attendance group is always required
if (empty($attendance_group)) {
    $errors[] = 'Attendance option is required.';
}

// 2. If "some_attending", individual attendance must be selected
if ($attendance_group === 'some_attending' && empty($individual_attendance)) {
    $errors[] = 'Please select who will be attending.';
}

// 3. If attending in any way, dietary requirements must be filled
if (
    in_array($attendance_group, ['attending', 'all_attending', 'some_attending']) &&
    empty($dietary_requirements)
) {
    $errors[] = 'Please provide dietary requirements or write "None".';
}

// 4. Only validate Stay/Dinner questions IF attending
$is_attending = in_array($attendance_group, ['attending', 'all_attending', 'some_attending']);
if ($is_attending) {
    if (isset($_POST['Staying_Onsite']) && $staying_onsite === '') {
        $errors[] = 'Please let us know if you’ll be staying at the venue.';
    }
    if ($staying_onsite === 'yes' && $friday_dinner === '') {
        $errors[] = 'Please confirm if you will join Friday dinner.';
    }
}

// 🛑 If validation fails, stop and display errors
if (!empty($errors)) {
    echo "<h2>There were errors in your submission:</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul><p><a href='javascript:history.back()'>Go Back and Fix</a></p>";
    exit;
}

// ✅ Build final data array for Google Sheets
$data = [
    'Invite_ID' => $invite_id,
    'Login_Code' => $login_code,
    'Attendance_Group' => $attendance_group,
    'Individual_Attendance' => $individual_attendance,
    'Dietary_Requirements' => $dietary_requirements,
    'Staying_Onsite' => $staying_onsite,
    'Friday_Dinner' => $friday_dinner,
    'Final_Notes' => $final_notes,
    'RSVP_Timestamp' => $timestamp,
];

// TEMP: Write to debug log for verification
file_put_contents('debug_log.txt', print_r($_POST, true), FILE_APPEND);
file_put_contents('debug_log.txt', print_r($data, true), FILE_APPEND);

// Send data to Google Apps Script endpoint
$jsonData = json_encode($data);

$ch = curl_init('https://script.google.com/macros/s/AKfycbxguaWfcJATy5iD0XHI1YhVXlfvx4srpgnWMJH8AuimKHB_pBG_Yvj4iXgdVbXvtPqE/exec');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Success or failure handling
if ($http_status === 200) {
    // ✅ Keep $_SESSION['invite'] alive for main.php
    $_SESSION['invite'] = $invite;
    header('Location: thankyou.php');
    exit;
} else {
    echo '<p>Something went wrong. Please try again.</p>';
    echo '<p>Status Code: ' . $http_status . '</p>';
    echo '<p>Response: ' . htmlspecialchars($response) . '</p>';
}
?>