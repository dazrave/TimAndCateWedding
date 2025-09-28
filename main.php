<?php
session_start();

if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$invite = $_SESSION['invite'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Tim & Cate's Wedding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f7f0;
            color: #333;
        }

        h1 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen px-4 text-center">

    <h1 class="text-4xl font-bold mb-6">Hello, <?= htmlspecialchars($invite['First_Name'] ?? 'Guest') ?>! 🎉</h1>

    <p class="mb-6 text-lg">Welcome to the full wedding site! This is just a placeholder while we build out the final version.</p>

    <a href="rsvp.php" class="px-6 py-3 rounded-full text-white bg-red-600 hover:bg-red-700 transition">
        Edit Your RSVP
    </a>

</body>
</html>