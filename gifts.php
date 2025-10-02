<!-- Gift Section -->
<section id="gifts" class="py-10 bg-gray-50 mt-10">
  <div class="container mx-auto px-6">
    <!-- Title -->
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Gifts</h2>
      <div class="w-24 h-1 mx-auto" style="background-color: #be3144;"></div>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-12">
      <!-- Image -->
      <div class="md:w-1/2" data-aos="fade-right">
        <img src="images/gifts01.webp" alt="Tuscan honeymoon inspiration" class="rounded-2xl shadow-xl w-full" />
      </div>

      <!-- Content -->
      <div class="md:w-1/2 space-y-6" data-aos="fade-left">
        <h3 class="text-2xl font-bold text-gray-800">A Little Note on Gifts</h3>
        <p class="text-gray-600 leading-relaxed">
          Our honeymoon will come a little later, once Phoebe's a bit older. We're dreaming of a week in the Tuscan hills, 
          followed by an Italian road trip ending with some time to unwind on the southern coast.
        </p>

        <div>
          <h4 class="text-xl font-bold text-gray-800 mb-3">Donations</h4>
          <p class="text-gray-600 mb-6">
            Your presence at our wedding is the greatest gift of all. But if you’d like to contribute to our honeymoon, here are some options:
          </p>

          <!-- Gift Links as Cards -->
          <div class="grid sm:grid-cols-3 gap-4">
            
            <!-- PayPal -->
            <div onclick="toggleBankDetails()" 
                 class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1 hover:scale-[1.02] cursor-pointer">
              <i data-feather="send" class="w-8 h-8 text-[#be3144] mb-3"></i>
              <span class="font-semibold text-gray-800">Paypal</span>
              <div id="bank-details" class="hidden mt-4 text-sm text-gray-600 text-center space-y-1 w-full">
                <p>
                <a href="https://www.paypal.com" target="_blank" class="text-[#be3144] underline hover:text-[#9a2534]">
                Click here
                </a> to donate via PayPal
                </p>
              </div>

            <!-- Monzo -->
            <div onclick="toggleBankDetails()" 
                 class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1 hover:scale-[1.02] cursor-pointer">
              <i data-feather="smartphone" class="w-8 h-8 text-[#be3144] mb-3"></i>
              <span class="font-semibold text-gray-800">Monzo</span>
              <div id="bank-details" class="hidden mt-4 text-sm text-gray-600 text-center space-y-1 w-full">
                <p>
                <a href="https://www.monzo.com" target="_blank" class="text-[#be3144] underline hover:text-[#9a2534]">
                Click here
                </a> to donate via Monzo
                </p>
              </div>

            <!-- Bank Transfer (Expandable Card) -->
            <div onclick="toggleBankDetails()" 
                 class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1 hover:scale-[1.02] cursor-pointer">
              <i data-feather="credit-card" class="w-8 h-8 text-[#be3144] mb-3"></i>
              <span class="font-semibold text-gray-800">Bank Transfer</span>
              <div id="bank-details" class="hidden mt-4 text-sm text-gray-600 text-center space-y-1 w-full">
                <p><span class="font-semibold">Name:</span> Me</p>
                <p><span class="font-semibold">Sort Code:</span> 11-11-11</p>
                <p><span class="font-semibold">Account Number:</span> 12345678</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'components/scripts.php'; ?>

<script>
  function toggleBankDetails() {
    const details = document.getElementById('bank-details');
    details.classList.toggle('hidden');
    if (!details.classList.contains('hidden')) {
      details.classList.add('animate-fadeIn');
    } else {
      details.classList.remove('animate-fadeIn');
    }
  }
</script>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out forwards;
  }
</style>

