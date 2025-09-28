<?php
session_start();

// Debug logger function
function log_debug($message) {
    $logfile = __DIR__ . '/debug_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logfile, "[$timestamp] $message\n", FILE_APPEND);
}

$login_code = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login_code'])) {
    $login_code = trim($_POST['login_code']);
    log_debug("Submitted login code: $login_code");

    $api_url = 'https://script.google.com/macros/s/AKfycbxguaWfcJATy5iD0XHI1YhVXlfvx4srpgnWMJH8AuimKHB_pBG_Yvj4iXgdVbXvtPqE/exec?login_code=' . urlencode($login_code);
    $response = file_get_contents($api_url);

    if ($response === false) {
        $error_message = "We're having trouble connecting. Please try again later.";
        log_debug("API request failed.");
    } else {
        log_debug("API response: $response");

        $data = json_decode($response, true);

        if ($data && $data['status'] === 'success') {
            log_debug("Decoded API success. Attendance_Group: " . ($data['data']['Attendance_Group'] ?? 'NOT SET'));

            $_SESSION['invite'] = $data['data'];

            // ✅ Redirect based on whether they've already RSVP'd
            if (isset($data['data']['Attendance_Group']) && trim($data['data']['Attendance_Group']) !== '') {
                log_debug("Redirecting to main.php");
                header('Location: main.php');
            } else {
                log_debug("Redirecting to rsvp.php");
                header('Location: rsvp.php');
            }
            exit;
        } else {
            $error_message = "We couldn’t find that code. Please check and try again.";
            log_debug("Login failed — invalid code or data.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tim & Cate's Wedding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f7f0;
            color: #333;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(190, 49, 68, 0.8) 0%, rgba(210, 105, 30, 0.8) 100%);
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .nav-link:hover {
            color: #be3144 !important;
        }

        .btn-primary {
            background-color: #be3144;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #9a2534;
            transform: translateY(-2px);
        }

        .section-divider {
            height: 80px;
            background: linear-gradient(to right bottom, #c45400 0%, #c45500 50%, #994900 50%, #994900 100%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 80px));
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center text-white hero-gradient">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <img src="https://stillwatereventcenter.com/wp-content/uploads/2022/09/F6AABA4A-4EE0-4988-ADC1-9DE46EB6DC0C-940x675.jpg" alt="Lake District" class="absolute inset-0 w-full h-full object-cover" />
        <div class="relative z-10 px-6" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Tim & Catherine</h1>
            <p class="text-xl md:text-2xl mb-8">Saturday, 10th October 2026<br>Merewood Country House Hotel, Windermere</p>

            <div class="flex justify-center space-x-4 mb-12">
                <div class="countdown-item rounded-lg p-4 w-20">
                    <div class="text-3xl font-bold" id="days">00</div>
                    <div class="text-sm">Days</div>
                </div>
                <div class="countdown-item rounded-lg p-4 w-20">
                    <div class="text-3xl font-bold" id="hours">00</div>
                    <div class="text-sm">Hours</div>
                </div>
                <div class="countdown-item rounded-lg p-4 w-20">
                    <div class="text-3xl font-bold" id="minutes">00</div>
                    <div class="text-sm">Minutes</div>
                </div>
                <div class="countdown-item rounded-lg p-4 w-20">
                    <div class="text-3xl font-bold" id="seconds">00</div>
                    <div class="text-sm">Seconds</div>
                </div>
            </div>

            <div class="mb-8 w-full max-w-xs mx-auto">
                <form method="POST" action="#login" id="login" class="mb-8 w-full max-w-xs mx-auto">
                    <?php if (!empty($error_message)) : ?>
                        <div class="mb-4 text-red-600 font-medium bg-red-100 p-2 rounded-md text-center">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>

                    <input
                        type="text"
                        name="login_code"
                        value="<?= htmlspecialchars($login_code) ?>"
                        placeholder="Enter your code here"
                        required
                        class="w-full px-4 py-2 rounded-full placeholder-white text-center text-white font-bold focus:outline-none focus:ring-4 focus:ring-white bg-white/40 border border-white/40 backdrop-blur/80"
                    />

                    <button
                        type="submit"
                        class="mt-4 w-full px-4 py-2 rounded-full text-white font-bold bg-red-600 hover:bg-red-700 transition-all"
                    >
                        Continue
                    </button>
                </form>
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
        function updateCountdown() {
            const weddingDate = new Date("October 10, 2026 13:00:00").getTime();
            const now = new Date().getTime();
            const distance = weddingDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
        feather.replace();
    </script>
</body>
</html>