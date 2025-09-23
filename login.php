<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tim & Cate's Wedding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500&display=swap');
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f7f0;
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
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-xl">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Wedding Guest Login
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Please enter your access code to view your personalized invitation
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="verify.php">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="access-code" class="sr-only">Access Code</label>
                        <input id="access-code" name="access_code" type="text" required
                            class="appearance-none rounded-lg relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-be3144 focus:border-be3144 focus:z-10 sm:text-sm"
                            placeholder="Enter your access code">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-be3144 hover:bg-9a2534 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-be3144">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>