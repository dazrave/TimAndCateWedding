<!-- FAQ Section -->
<section class="py-20 bg-gray-50 mt-16">
  <div class="container mx-auto px-6">
    <!-- Title -->
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
      <div class="w-24 h-1 bg-[#be3144] mx-auto"></div>
    </div>

    <div class="max-w-3xl mx-auto space-y-6" data-aos="fade-up">

      <!-- FAQ Card -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden transition transform hover:scale-[1.01]">
        <button class="w-full flex items-center justify-between p-6 focus:outline-none faq-toggle">
          <h3 class="font-bold text-gray-800 text-left">What's the dress code?</h3>
          <i data-feather="chevron-down" class="text-[#be3144] transition-transform duration-300"></i>
        </button>
        <div class="faq-content hidden px-6 pb-6 text-gray-600">
          We’d love our guests to dress smartly for our big day. Think suits and dresses – no jeans, polo shirts or trainers please. We kindly ask that ladies avoid wearing white.
        </div>
      </div>

      <!-- FAQ Card -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden transition transform hover:scale-[1.01]">
        <button class="w-full flex items-center justify-between p-6 focus:outline-none faq-toggle">
          <h3 class="font-bold text-gray-800 text-left">What about dietary requirements?</h3>
          <i data-feather="chevron-down" class="text-[#be3144] transition-transform duration-300"></i>
        </button>
        <div class="faq-content hidden px-6 pb-6 text-gray-600">
          Please let us know about any dietary requirements when you RSVP. Our venue is very accommodating and will ensure there are delicious options for everyone.
        </div>
      </div>

      <!-- FAQ Card -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden transition transform hover:scale-[1.01]">
        <button class="w-full flex items-center justify-between p-6 focus:outline-none faq-toggle">
          <h3 class="font-bold text-gray-800 text-left">Are children invited?</h3>
          <i data-feather="chevron-down" class="text-[#be3144] transition-transform duration-300"></i>
        </button>
        <div class="faq-content hidden px-6 pb-6 text-gray-600">
          We want all of our guests to enjoy themselves – even those that are parents. We also have a limited number of guests. So we will only be inviting children that are immediate family members. We apologise if this makes things complicated for you.
        </div>
      </div>

      <!-- FAQ Card -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden transition transform hover:scale-[1.01]">
        <button class="w-full flex items-center justify-between p-6 focus:outline-none faq-toggle">
          <h3 class="font-bold text-gray-800 text-left">What about gifts?</h3>
          <i data-feather="chevron-down" class="text-[#be3144] transition-transform duration-300"></i>
        </button>
        <div class="faq-content hidden px-6 pb-6 text-gray-600">
          Your presence at our wedding is the greatest gift of all. However, if you'd like to contribute to our honeymoon, please see our gift section.
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  // FAQ Toggle Logic with smooth animation
  document.querySelectorAll(".faq-toggle").forEach((btn) => {
    btn.addEventListener("click", () => {
      const card = btn.parentElement;
      const content = card.querySelector(".faq-content");
      const icon = btn.querySelector("i[data-feather='chevron-down']");

      if (content.classList.contains("hidden")) {
        content.classList.remove("hidden");
        content.style.maxHeight = content.scrollHeight + "px";
        icon.classList.add("rotate-180");
      } else {
        content.classList.add("hidden");
        content.style.maxHeight = null;
        icon.classList.remove("rotate-180");
      }
    });
  });
</script>