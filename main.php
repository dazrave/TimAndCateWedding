<?php
session_start();

// Redirect to index if no invite data
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$groupId = $_SESSION['invite']['Group_ID'] ?? null;
$stayingOnsite = $_SESSION['invite']['Staying_Onsite'] ?? '';
$userName = $_SESSION['invite']['User_Present_Name'] ?? 'Guest';

// Override logic: If Group 1 or 2 but NOT staying onsite, treat as Group 3
if (in_array($groupId, [1, 2]) && $stayingOnsite !== 'yes') {
    $effectiveGroup = 3;
} else {
    $effectiveGroup = $groupId;
}
?>

<?php include __DIR__ . '/components/header.php'; ?>

<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat] overflow-x-hidden">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <!-- Group Label Banner (Optional Debug / Group Visual) -->
    <?php /*
    if ($groupId): ?>
        <div class="bg-red-700 text-white text-center py-4 text-xl font-bold">
            You are Group <?= htmlspecialchars($groupId) ?> 
            (Effective Group <?= htmlspecialchars($effectiveGroup) ?>)
        </div>
    <?php endif;
    */ ?>

    <!-- Welcome Banner -->
    <section class="text-center py-4 px-4 sm:px-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-bold font-[Playfair Display] mb-2 leading-tight text-gray-900 drop-shadow-sm">
                Welcome, <?= htmlspecialchars($userName) ?>!
            </h1>
            <p class="text-base md:text-lg text-[#666] leading-relaxed">
                We're so excited to celebrate with you. Scroll down for everything you need to know.
            </p>
        </div>
    </section>

    <!-- Dynamic Content Based on Effective Group -->
    <?php
    switch ($effectiveGroup) {
        case 1:
            include __DIR__ . '/venue.php';
            include __DIR__ . '/venue_weekend.php';
            include __DIR__ . '/travel.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            include __DIR__ . '/photos.php';
            break;

        case 2:
            include __DIR__ . '/venue.php';
            include __DIR__ . '/venue_weekend.php';
            include __DIR__ . '/travel.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            include __DIR__ . '/photos.php';
            break;

        case 3:
        default:
            include __DIR__ . '/venue.php';
            include __DIR__ . '/thebigday.php';
            include __DIR__ . '/faq.php';
            include __DIR__ . '/gifts.php';
            include __DIR__ . '/photos.php';
            break;
    }
    ?>

    <?php include __DIR__ . '/components/footer.php'; ?>
    <?php include __DIR__ . '/components/scripts.php'; ?>

</body>
</html>