<?php
// navbar.php
?>
<nav class="sticky top-0 bg-white shadow-md z-50 px-6 py-4 flex justify-between items-center">
    <!-- Logo -->
    <div class="font-bold text-lg">Tim & Cate's Wedding</div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex space-x-6">
        <a href="#venue" class="hover:text-[#be3144]">Venue</a>
        <a href="#travel" class="hover:text-[#be3144]">Travel</a>
        <a href="#thebigday" class="hover:text-[#be3144]">The Big Day</a>
        <a href="#faq" class="hover:text-[#be3144]">FAQ</a>
        <a href="#gifts" class="hover:text-[#be3144]">Gifts</a>
        <a href="#photos" class="hover:text-[#be3144]">Photos</a>
        <a href="rsvp.php" class="text-[#be3144] font-bold underline">Change RSVP</a>
    </div>

    <!-- Mobile Hamburger -->
    <button id="menu-toggle" class="md:hidden focus:outline-none">
        <i data-feather="menu" class="w-6 h-6 text-gray-700"></i>
    </button>
</nav>

<!-- Mobile Menu (hidden by default) -->
<div id="mobile-menu" class="hidden flex-col bg-white shadow-md px-6 py-4 space-y-4 md:hidden">
    <a href="#venue" class="block hover:text-[#be3144]">Venue</a>
    <a href="#travel" class="block hover:text-[#be3144]">Travel</a>
    <a href="#thebigday" class="block hover:text-[#be3144]">The Big Day</a>
    <a href="#faq" class="block hover:text-[#be3144]">FAQ</a>
    <a href="#gifts" class="block hover:text-[#be3144]">Gifts</a>
    <a href="#photos" class="block hover:text-[#be3144]">Photos</a>
    <a href="rsvp.php" class="block text-[#be3144] font-bold underline">Change RSVP</a>
</div>

<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>