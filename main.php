<?php
session_start();

// Redirect to index if no invite data
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

// Pull group + RSVP choices from session
$groupId = $_SESSION['invite']['Group_ID'] ?? 3; // fallback to 3
$userName = $_SESSION['invite']['User_Present_Name'] ?? 'Guest';
$stayingOnsite = $_SESSION['invite']['Staying_Onsite'] ?? 'no'; // default to "no" if not set

// Decide what content group they should actually see
$effectiveGroup = 3; // default fallback to lightweight view
if (in_array($groupId, [1, 2]) && $stayingOnsite === 'yes') {
    $effectiveGroup = $groupId; // show their true group if staying onsite
}
?>

<?php include __DIR__ . '/components/header.php'; ?>

<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat] overflow-x-hidden">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <!-- Group Label Banner (Optional Debug / Group Visual) -->
    <?php if ($groupId): ?>
        <div class="bg-red-700 text-white text-center py-4 text-xl font-bold">
            Logged in as Group <?= htmlspecialchars($groupId) ?> 
            (Effective View: Group <?= htmlspecialchars($effectiveGroup) ?>)
        </div>
    <?php endif; ?>

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
            include __DIR__ . '/photos.php';
            break;
    }
    ?>

    <?php include __DIR__ . '/components/footer.php'; ?>
    <?php include __DIR__ . '/components/scripts.php'; ?>

</body>
</html>