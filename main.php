<?php
session_start();

// Redirect to index if no invite data
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$groupId = $_SESSION['invite']['Group_ID'] ?? null;
$userName = $_SESSION['invite']['User_Present_Name'] ?? 'Guest';
?>

<body class="overflow-x-hidden">
    <?php
    $group_id = $_SESSION['invite']['Group_ID'] ?? null;

    if ($group_id) {
        echo "<div class='bg-red-700 text-white text-center py-4 text-xl font-bold'>This is the Group {$group_id} page</div>";
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?= htmlspecialchars($userName) ?>!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat]">

    <!-- Navbar -->
    <nav class="sticky top-0 bg-white shadow-md z-50 px-6 py-4 flex justify-between items-center">
        <div class="font-bold text-lg">Tim & Cate's Wedding</div>
        <div class="space-x-4 hidden md:block">
            <a href="#venue" class="hover:text-[#be3144]">Venue</a>
            <a href="#travel" class="hover:text-[#be3144]">Travel</a>
            <a href="#thebigday" class="hover:text-[#be3144]">The Big Day</a>
            <a href="#faq" class="hover:text-[#be3144]">FAQ</a>
            <a href="#gifts" class="hover:text-[#be3144]">Gifts</a>
            <a href="#photos" class="hover:text-[#be3144]">Photos</a>
            <a href="rsvp.php" class="text-[#be3144] font-bold underline">Change RSVP</a>
        </div>
    </nav>

    <!-- Welcome Banner -->
    <section class="text-center py-12 px-6">
        <h1 class="text-3xl md:text-5xl font-bold font-[Playfair Display] mb-4">Welcome, <?= htmlspecialchars($userName) ?>!</h1>
        <p class="text-lg text-[#666]">We're so excited to celebrate with you. Scroll down for everything you need to know.</p>
    </section>

    <!-- Dynamic Section Inclusion -->
    <?php
    $groupFile = "group{$groupId}_sections.php";
    if (file_exists($groupFile)) {
        include $groupFile;
    } else {
        echo "<section class='text-center text-red-600'>We couldn’t find your information. Please contact us directly.</section>";
    }
    ?>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 text-center mt-16">
        <p>&copy; 2026 Tim & Cate's Wedding. All rights reserved.</p>
        <p class="text-sm text-gray-400">Merewood Country House Hotel, Windermere</p>
    </footer>

</body>
</html>