<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gifts | Tim & Cate's Wedding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500&display=swap');
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f7f0;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
        }
        
        .btn-primary {
            background-color: #be3144;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #9a2534;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="index.html" class="text-2xl font-bold text-gray-800 hover:text-be3144 transition duration-300">
                    <span class="text-be3144">Tim</span> & <span class="text-d2691e">Cate's Wedding</span>
                </a>
                <div class="hidden md:flex space-x-8">
                    <a href="thebigday.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">The Big Day</a>
                    <a href="travel.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">Travel</a>
                    <a href="venue.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">Venue</a>
                    <a href="rsvp.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">RSVP</a>
                    <a href="faq.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">FAQ</a>
                    <a href="photos.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">Photos</a>
                    <a href="gifts.html" class="nav-link text-gray-700 hover:text-be3144 transition duration-300">Gifts</a>
                </div>
                <button class="md:hidden focus:outline-none">
                    <i data-feather="menu" class="text-gray-700"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Gift Section -->
    <section class="py-20 bg-white mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Gifts</h2>
                <div class="w-24 h-1 bg-be3144 mx-auto"></div>
            </div>
            
            <div class="flex flex-col md:flex-row items-center mb-16">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10" data-aos="fade-right">
                    <img src="https://italy4real.com/wp-content/uploads/2015/10/sebastian-leonhardt-PkWac9CLWVA-unsplash-1.jpg" alt="Merewood Country House Hotel" class="rounded-lg shadow-xl">
                </div>
                <div class="md:w-1/2" data-aos="fade-left">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Gifts</h3>
                    <p class="text-gray-600 mb-6">Our Honeymoon will come a little later, once Phoebe's a bit older. We're dreaming of a week in the Tuscan hills, followed by an Italian road trip ending with some time to unwind on the southern coast.</p>
                    
                    <div class="mb-6">
                        <h2 class="font-bold text-gray-800 mb-4">Donations</h4>
                        <p class="text-gray-600">Truly, your presence at our wedding is the greatest gift of all. However, if you'd like to contribute to our honeymoon, please use the links below:</p>
                        <p class="text-gray-600">
                            <a href="https://www.google.com" class="underline hover:text-be3144">PAYPAL</a><br>
                            <a href="https://www.google.com" class="underline hover:text-be3144">MONZO</a><br>
                            <a href="https://www.google.com" class="underline hover:text-be3144">BANK TRANSFER</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold">
                        <span class="text-be3144">Tim</span> & <span class="text-d2691e">Cate</span>
                    </h2>
                    <p class="text-gray-400 mt-2">10.10.2026</p>
                </div>
                
                <div class="text-center md:text-right">
                    <p class="text-gray-400">Merewood Country House Hotel</p>
                    <p class="text-gray-400">Windermere, Lake District, UK</p>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© 2026 Tim & Cate's Wedding. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>