<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

// Build the data array
$data = [
    'Invite_ID' => $_POST['Invite_ID'] ?? '',
    'Login_Code' => $_POST['Login_Code'] ?? '',
    'Attendance_Group' => $_POST['Attendance_Group'] ?? '',
    'Individual_Attendance' => isset($_POST['Individual_Attendance']) ? $_POST['Individual_Attendance'] : [],
    'Dietary_Requirements' => $_POST['Dietary_Requirements'] ?? '',
    'Staying_Onsite' => $_POST['Staying_Onsite'] ?? '',
    'Friday_Dinner' => $_POST['Friday_Dinner'] ?? '',
    'Final_Notes' => $_POST['Final_Notes'] ?? '',
    'RSVP_Timestamp' => date('Y-m-d H:i:s'),
];

// TEMP DEBUG
file_put_contents('debug_log.txt', print_r($_POST, true), FILE_APPEND);
file_put_contents('debug_log.txt', print_r($data, true), FILE_APPEND);

// Convert to JSON
$jsonData = json_encode($data);

// Set up cURL to send JSON
$ch = curl_init('https://script.google.com/macros/s/AKfycbxguaWfcJATy5iD0XHI1YhVXlfvx4srpgnWMJH8AuimKHB_pBG_Yvj4iXgdVbXvtPqE/exec');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // ✅ Follow the redirect from Google

// Execute the request
$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
if ($http_status === 200) {
    header('Location: thankyou.html');
    exit;
} else {
    echo 'Something went wrong. Please try again.';
}
?>