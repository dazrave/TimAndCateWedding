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

<?php include __DIR__ . '/components/header.php'; ?>

<body class="bg-[#f9f7f0] text-[#333] font-[Montserrat] overflow-x-hidden">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <!-- Group Label Banner (Optional Debug / Group Visual) -->
    <?php if ($groupId): ?>
        <div class="bg-red-700 text-white text-center py-4 text-xl font-bold">
            This is the Group <?= htmlspecialchars($groupId) ?> page
        </div>
    <?php endif; ?>

    <!-- Welcome Banner -->
    <section class="text-center py-12 px-6">
        <h1 class="text-3xl md:text-5xl font-bold font-[Playfair Display] mb-4">
            Welcome, <?= htmlspecialchars($userName) ?>!
        </h1>
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

    <?php include __DIR__ . '/components/footer.php'; ?>
    <?php include __DIR__ . '/components/scripts.php'; ?>

</body>
</html>