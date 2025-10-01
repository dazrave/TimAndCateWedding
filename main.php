<?php
session_start();

// Redirect to index if no invite data
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$groupId = $_SESSION['invite']['Group_ID'] ?? 3; // fallback to 3
$userName = $_SESSION['invite']['User_Present_Name'] ?? 'Guest';
?>

<?php include __DIR__ . '/components/header.php'; ?>

<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat] overflow-x-hidden">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <!-- Group Label Banner (Optional Debug / Group Visual) -->
    <div class="bg-red-700 text-white text-center py-4 text-xl font-bold">
        This is the Group <?= htmlspecialchars($groupId) ?> page
    </div>

    <!-- Welcome Banner -->
    <section class="text-center py-12 px-6">
        <h1 class="text-3xl md:text-5xl font-bold font-[Playfair Display] mb-4">
            Welcome, <?= htmlspecialchars($userName) ?>!
        </h1>
        <p class="text-lg text-[#666]">We're so excited to celebrate with you. Scroll down for everything you need to know.</p>
    </section>

    <!-- Dynamic Content Based on Group -->
    <?php
    switch ($groupId) {
        case 1:
            // Fully funded guests: show all sections
            include __DIR__ . '/venue.php';
            include __DIR__ . '/travel.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            include __DIR__ . '/photos.php';
            break;

        case 2:
            // Subsidised guests: show all sections + (later) payment info
            include __DIR__ . '/venue.php';
            include __DIR__ . '/travel.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            include __DIR__ . '/photos.php';
            break;

        case 3:
        default:
            // Day guests only: show restricted sections
            include __DIR__ . '/venue.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            break;
    }
    ?>

    <?php include __DIR__ . '/components/footer.php'; ?>
    <?php include __DIR__ . '/components/scripts.php'; ?>

</body>
</html>