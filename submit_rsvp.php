<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

$data = [
    'Invite_ID' => $_POST['Invite_ID'] ?? '',
    'Login_Code' => $_POST['Login_Code'] ?? '',
    'Attendance_Group' => $_POST['Attendance_Group'] ?? '',
    'Individual_Attendance' => isset($_POST['Individual_Attendance']) ? implode(', ', $_POST['Individual_Attendance']) : '',
    'Dietary_Requirements' => $_POST['Dietary_Requirements'] ?? '',
    'Staying_Onsite' => $_POST['Staying_Onsite'] ?? '',
    'Friday_Dinner' => $_POST['Friday_Dinner'] ?? '',
    'Final_Notes' => $_POST['Final_Notes'] ?? '',
    'RSVP_Timestamp' => date('Y-m-d H:i:s'),
];

$url = 'https://script.google.com/macros/s/AKfycbxguaWfcJATy5iD0XHI1YhVXlfvx4srpgnWMJH8AuimKHB_pBG_Yvj4iXgdVbXvtPqE/exec';

// Initialize cURL
$ch = curl_init($url);

// Configure cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Execute the POST request
$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Process response
if ($http_status === 200) {
    // Optionally parse response JSON and show message
    header('Location: thankyou.html'); // You can create this file or change the redirect
    exit;
} else {
    echo 'Something went wrong. Please try again.';
}
?>