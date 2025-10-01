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

            if (!empty($data['data']['Attendance_Group'])) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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

        .btn-primary {
            background-color: #be3144;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #9a2534;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <main>
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center text-white hero-gradient text-center">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <img src="/images/autumn_wedding.webp" alt="Lake District" class="absolute inset-0 w-full h-full object-cover" />

            <div class="relative z-10 px-4 w-full max-w-xl" data-aos="fade-up">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6">Tim & Catherine</h1>
                <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed">
                    Saturday, 10th October 2026<br>Merewood Country House Hotel, Windermere
                </p>

                <div class="flex justify-center space-x-2 sm:space-x-4 mb-8">
                    <div class="countdown-item rounded-lg p-3 sm:p-4 w-16 sm:w-20">
                        <div class="text-xl sm:text-3xl font-bold" id="days">00</div>
                        <div class="text-xs sm:text-sm">Days</div>
                    </div>
                    <div class="countdown-item rounded-lg p-3 sm:p-4 w-16 sm:w-20">
                        <div class="text-xl sm:text-3xl font-bold" id="hours">00</div>
                        <div class="text-xs sm:text-sm">Hours</div>
                    </div>
                    <div class="countdown-item rounded-lg p-3 sm:p-4 w-16 sm:w-20">
                        <div class="text-xl sm:text-3xl font-bold" id="minutes">00</div>
                        <div class="text-xs sm:text-sm">Minutes</div>
                    </div>
                    <div class="countdown-item rounded-lg p-3 sm:p-4 w-16 sm:w-20">
                        <div class="text-xl sm:text-3xl font-bold" id="seconds">00</div>
                        <div class="text-xs sm:text-sm">Seconds</div>
                    </div>
                </div>

                <!-- Login Form -->
                <form method="POST" action="#login" id="login" class="w-full max-w-xs mx-auto">
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
        </section>
    </main>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

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