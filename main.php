<?php
session_start();

// Redirect to index if no invite data
if (!isset($_SESSION['invite'])) {
    header('Location: index.php');
    exit;
}

$groupId = $_SESSION['invite']['Group_ID'] ?? 3; // 👈 Default to 3 if missing
$userName = $_SESSION['invite']['User_Present_Name'] ?? 'Guest';
?>

<?php include __DIR__ . '/components/header.php'; ?>

<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat] overflow-x-hidden">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <!-- Group Label Banner -->
    <?php if ($groupId): ?>
        <div class="bg-red-700 text-white text-center py-3 text-lg font-semibold">
            You are Group <?= htmlspecialchars($groupId) ?>
        </div>
    <?php endif; ?>

    <!-- Welcome Banner -->
    <section class="text-center py-12 px-6">
        <h1 class="text-3xl md:text-5xl font-bold font-[Playfair Display] mb-4">
            Welcome, <?= htmlspecialchars($userName) ?>!
        </h1>
        <p class="text-lg text-[#666]">
            We're so excited to celebrate with you. Scroll down for everything you need to know.
        </p>
    </section>

    <!-- Dynamic Content Based on Group -->
    <?php if ($groupId == 1): ?>
        
        <!-- Group 1: Fully funded accommodation -->
        <?php include __DIR__ . '/venue.php'; ?>
        <?php include __DIR__ . '/travel.php'; ?>
        <?php include __DIR__ . '/thebigday.php'; ?>
        <?php include __DIR__ . '/faq.php'; ?>
        <?php include __DIR__ . '/gifts.php'; ?>
        <?php include __DIR__ . '/photos.php'; ?>

    <?php elseif ($groupId == 2): ?>

        <!-- Group 2: Subsidised accommodation (show payment option) -->
        <?php include __DIR__ . '/venue.php'; ?>

        <section class="py-16 bg-white text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Accommodation Contribution</h2>
            <p class="text-gray-700 mb-6 max-w-xl mx-auto">
                As part of Group 2, you are invited to stay with us at the venue.
                A contribution of <strong>£100 per night</strong> is required for your accommodation.
            </p>
            <a href="payment.php" 
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-full transition">
               Pay Now
            </a>
        </section>

        <?php include __DIR__ . '/travel.php'; ?>
        <?php include __DIR__ . '/thebigday.php'; ?>
        <?php include __DIR__ . '/faq.php'; ?>
        <?php include __DIR__ . '/gifts.php'; ?>
        <?php include __DIR__ . '/photos.php'; ?>

    <?php else: ?>

        <!-- Group 3 (default fallback): Day guests only -->
        <?php include __DIR__ . '/venue.php'; ?>
        <?php include __DIR__ . '/thebigday.php'; ?>
        <?php include __DIR__ . '/faq.php'; ?>
        <?php include __DIR__ . '/gifts.php'; ?>
        <?php include __DIR__ . '/photos.php'; ?>

    <?php endif; ?>

    <?php include __DIR__ . '/components/footer.php'; ?>
    <?php include __DIR__ . '/components/scripts.php'; ?>

</body>
</html>