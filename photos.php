<!-- Photos Section -->
<section id="photos" class="py-20 bg-gray-50 mt-16">
  <div class="container mx-auto px-6">
    <!-- Title -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Photos</h2>
      <div class="w-24 h-1 mx-auto" style="background-color: #be3144;"></div>
      <p class="text-gray-600 mt-6">
        We’d love to see your photos from the big day!  
      </p>
      <a href="https://www.google.com" target="_blank" 
         class="inline-block mt-4 px-6 py-3 bg-[#be3144] text-white rounded-full shadow-md hover:bg-[#9a2534] transition transform hover:-translate-y-1 hover:scale-[1.02]">
        Upload Your Photos
      </a>
    </div>

    <!-- Gallery -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" data-aos="fade-up">
      <!-- Image -->
      <div class="overflow-hidden rounded-xl shadow-md group">
        <img src="http://static.photos/nature/320x240/1" alt="Gallery 1" 
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 cursor-pointer">
      </div>
      <div class="overflow-hidden rounded-xl shadow-md group">
        <img src="http://static.photos/nature/320x240/2" alt="Gallery 2" 
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 cursor-pointer">
      </div>
      <div class="overflow-hidden rounded-xl shadow-md group">
        <img src="http://static.photos/nature/320x240/3" alt="Gallery 3" 
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 cursor-pointer">
      </div>
      <div class="overflow-hidden rounded-xl shadow-md group">
        <img src="http://static.photos/nature/320x240/4" alt="Gallery 4" 
             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 cursor-pointer">
      </div>
    </div>
  </div>
</section>

<?php include 'components/scripts.php'; ?>