<?php
// navbar.php

// Work out what sections to display based on effective group
$navLinks = [];

switch ($effectiveGroup ?? 3) {
    case 1:
    case 2:
        // Weekend guests
        $navLinks = [
            "venue" => "Venue",
            "travel" => "Travel",
            "thebigday" => "The Big Day",
            "faq" => "FAQ",
            "gifts" => "Gifts",
            "photos" => "Photos",
        ];
        break;

    case 3:
    default:
        // Day guests only
        $navLinks = [
            "venue" => "Venue",
            "thebigday" => "The Big Day",
            "faq" => "FAQ",
            "gifts" => "Gifts",
            "photos" => "Photos",
        ];
        break;
}
?>

<nav class="sticky top-0 bg-white shadow-md z-50 px-6 py-4 flex justify-between items-center">
    <div class="font-bold text-lg">Tim & Cate's Wedding</div>

    <!-- Desktop menu -->
    <div class="space-x-4 hidden md:block">
        <?php foreach ($navLinks as $id => $label): ?>
            <a href="#<?= $id ?>" class="hover:text-[#be3144]"><?= htmlspecialchars($label) ?></a>
        <?php endforeach; ?>
        <a href="rsvp.php" class="text-[#be3144] font-bold underline">Change RSVP</a>
    </div>

    <!-- Mobile button -->
    <button id="menu-toggle" class="md:hidden focus:outline-none">
        <i data-feather="menu" class="text-gray-700"></i>
    </button>
</nav>

<!-- Mobile dropdown -->
<div id="mobile-menu" class="hidden bg-white shadow-md px-6 py-4 space-y-3 md:hidden">
    <?php foreach ($navLinks as $id => $label): ?>
        <a href="#<?= $id ?>" class="block text-gray-800 hover:text-[#be3144]"><?= htmlspecialchars($label) ?></a>
    <?php endforeach; ?>
    <a href="rsvp.php" class="block text-[#be3144] font-bold underline">Change RSVP</a>
</div>

<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuLinks = mobileMenu.querySelectorAll('a');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  // Close mobile menu when clicking a link
  menuLinks.forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
    });
  });
</script>