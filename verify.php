<?php
session_start();

$login_code = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login_code'])) {
    $login_code = trim($_POST['login_code']);

    // Replace this with your actual Web App URL
    $api_url = 'https://script.google.com/macros/library/d/11aSUpoCFJgH9P0ny_xTcWrn12VpWW53XJHEA12ZwCzb1RV_LzsMZt4qZ/1/exec?login_code=' . urlencode($login_code);

    $response = file_get_contents($api_url);

    if ($response === false) {
        $error_message = "We're having trouble connecting. Please try again shortly.";
    } else {
        $data = json_decode($response, true);

        if ($data && $data['status'] === 'success') {
            $_SESSION['invite'] = $data['data'];
            header('Location: rsvp.php');
            exit;
        } else {
            $error_message = "We couldn’t find that code. Please check and try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Invite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Enter Your Invite Code</h1>

        <?php if (!empty($error_message)): ?>
            <div class="mb-4 text-red-600 font-medium bg-red-100 p-2 rounded-md">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="verify.php" class="space-y-4">
            <input
                type="text"
                name="login_code"
                value="<?= htmlspecialchars($login_code) ?>"
                placeholder="Enter your code"
                required
                class="w-full px-4 py-2 rounded-full placeholder-gray-500 text-center text-gray-900 font-bold focus:outline-none focus:ring-4 focus:ring-red-300 bg-gray-100 border border-gray-300"
            >
            <button
                type="submit"
                class="w-full px-4 py-2 rounded-full text-white font-bold bg-red-600 hover:bg-red-700 transition-all"
            >
                Continue
            </button>
        </form>
    </div>
</body>
</html>