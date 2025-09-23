<?php
session_start();

// Sample guest groups (would normally come from database)
$guestGroups = [
    '1000' => ['access_level' => 1, 'redirect' => 'rsvp-group1.php'],
    '2000' => ['access_level' => 2, 'redirect' => 'rsvp-group2.php'],
    '3000' => ['access_level' => 3, 'redirect' => 'rsvp-group3.php']
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accessCode = trim($_POST['access_code']);
    
    if (array_key_exists($accessCode, $guestGroups)) {
        $_SESSION['access_level'] = $guestGroups[$accessCode]['access_level'];
        $_SESSION['logged_in'] = true;
        header("Location: " . $guestGroups[$accessCode]['redirect']);
        exit();
    } else {
        $error = "Invalid access code. Please try again.";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>