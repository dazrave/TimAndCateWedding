<nav class="sticky top-0 bg-white shadow-md z-50 px-6 py-4 flex justify-between items-center">
  <div class="font-bold text-lg">Tim & Cate's Wedding</div>

  <!-- Desktop Links -->
  <div class="space-x-4 hidden md:block">
    <a href="#venue" class="hover:text-[#be3144]">Venue</a>
    <a href="#travel" class="hover:text-[#be3144]">Travel</a>
    <a href="#thebigday" class="hover:text-[#be3144]">The Big Day</a>
    <a href="#faq" class="hover:text-[#be3144]">FAQ</a>
    <a href="#gifts" class="hover:text-[#be3144]">Gifts</a>
    <a href="#photos" class="hover:text-[#be3144]">Photos</a>
    <a href="rsvp.php" class="text-[#be3144] font-bold underline">Change RSVP</a>
  </div>

  <!-- Hamburger -->
  <button id="menu-toggle" class="md:hidden focus:outline-none">
    <i data-feather="menu" class="text-gray-700"></i>
  </button>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="hidden bg-white shadow-md md:hidden">
  <div class="flex flex-col space-y-4 p-4">
    <a href="#venue" class="hover:text-[#be3144]">Venue</a>
    <a href="#travel" class="hover:text-[#be3144]">Travel</a>
    <a href="#thebigday" class="hover:text-[#be3144]">The Big Day</a>
    <a href="#faq" class="hover:text-[#be3144]">FAQ</a>
    <a href="#gifts" class="hover:text-[#be3144]">Gifts</a>
    <a href="#photos" class="hover:text-[#be3144]">Photos</a>
    <a href="rsvp.php" class="text-[#be3144] font-bold underline">Change RSVP</a>
  </div>
</div>

<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuLinks = mobileMenu.querySelectorAll('a');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  function scrollToSection(id) {
    const target = document.getElementById(id);
    if (target) {
      const headerOffset = 80; // sticky nav height
      const elementPosition = target.getBoundingClientRect().top + window.scrollY;
      const offsetPosition = elementPosition - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    }
  }

  menuLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      const href = link.getAttribute('href');
      if (href.startsWith('#')) {
        e.preventDefault();
        const sectionId = href.substring(1); // remove #
        scrollToSection(sectionId);
      }
      mobileMenu.classList.add('hidden');
    });
  });
</script>