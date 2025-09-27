<?php
session_start();
$attendance = $_SESSION['rsvp_attendance'] ?? '';
unset($_SESSION['rsvp_attendance']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RSVP Received – Tim & Cate’s Wedding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('/images/thankyou.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
    <div class="glass-card shadow-xl rounded-xl p-10 max-w-md text-center border border-white/30">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">🎉 RSVP Received</h1>
        <p class="text-gray-800 mb-6 text-lg leading-relaxed">
            <?php if ($attendance === 'not_attending'): ?>
                Thank you for letting us know.<br>
                We're really sorry you can’t make it but totally understand!<br>
                With love, Tim & Cate xx
            <?php else: ?>
                Thank you so much for letting us know.<br>
                We can't wait to celebrate with you!<br>
                With love, Tim & Cate xx
            <?php endif; ?>
        </p>
        <a href="index.php" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
            Continue to Website
        </a>
    </div>
</body>
</html>
</php>