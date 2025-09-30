<?php include('components/header.php'); ?>
<?php include('components/navbar.php'); ?>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50 mt-16">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
      <div class="w-24 h-1 bg-d2691e mx-auto"></div>
    </div>
    
    <div class="max-w-3xl mx-auto" data-aos="fade-up">
      
      <!-- Question 1 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="flex items-center justify-between p-6 cursor-pointer" onclick="toggleFAQ(1)">
          <h3 class="font-bold text-gray-800">What's the dress code?</h3>
          <i data-feather="chevron-down" class="text-be3144 transform transition-transform duration-300" id="faq-icon-1"></i>
        </div>
        <div class="px-6 pb-6 hidden" id="faq-content-1">
          <p class="text-gray-600">
            We’d love our guests to dress smartly for our big day. Think suits and dresses – no jeans, polo shirts or trainers please. We kindly ask that ladies avoid wearing white.
          </p>
        </div>
      </div>

      <!-- Question 2 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="flex items-center justify-between p-6 cursor-pointer" onclick="toggleFAQ(2)">
          <h3 class="font-bold text-gray-800">What about dietary requirements?</h3>
          <i data-feather="chevron-down" class="text-be3144 transform transition-transform duration-300" id="faq-icon-2"></i>
        </div>
        <div class="px-6 pb-6 hidden" id="faq-content-2">
          <p class="text-gray-600">
            Please let us know about any dietary requirements when you RSVP. Our venue is very accommodating and will ensure there are delicious options for everyone.
          </p>
        </div>
      </div>

      <!-- Question 3 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="flex items-center justify-between p-6 cursor-pointer" onclick="toggleFAQ(3)">
          <h3 class="font-bold text-gray-800">Are children invited?</h3>
          <i data-feather="chevron-down" class="text-be3144 transform transition-transform duration-300" id="faq-icon-3"></i>
        </div>
        <div class="px-6 pb-6 hidden" id="faq-content-3">
          <p class="text-gray-600">
            We want all of our guests to enjoy themselves – even those that are parents. We also have a limited number of guests. So we will only be inviting children that are immediate family members. We apologise if this makes things complicated for you.
          </p>
        </div>
      </div>

      <!-- Question 4 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex items-center justify-between p-6 cursor-pointer" onclick="toggleFAQ(4)">
          <h3 class="font-bold text-gray-800">What about gifts?</h3>
          <i data-feather="chevron-down" class="text-be3144 transform transition-transform duration-300" id="faq-icon-4"></i>
        </div>
        <div class="px-6 pb-6 hidden" id="faq-content-4">
          <p class="text-gray-600">
            Your presence at our wedding is the greatest gift of all. However, if you'd like to contribute to our honeymoon, please see our gift section.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('components/footer.php'); ?>
<?php include('components/scripts.php'); ?>

<script>
  // FAQ Toggle Logic
  function toggleFAQ(num) {
    const content = document.getElementById(`faq-content-${num}`);
    const icon = document.getElementById(`faq-icon-${num}`);
    
    if (content.classList.contains('hidden')) {
      content.classList.remove('hidden');
      icon.classList.add('rotate-180');
    } else {
      content.classList.add('hidden');
      icon.classList.remove('rotate-180');
    }
  }
</script>