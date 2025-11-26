<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/auth-style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body class="h-screen flex items-center justify-center bg-white">
  <div id="content" class="bg-white p-8 rounded-lg w-80 flex flex-col items-center space-y-6">
    <h1 class="text-lg font-bold text-gray-500 text-start">Enter Your Phone Number to receive a G-Digit OTP</h1>

    <div id="phoneWrapper" class="flex items-center border border-gray-300 rounded-md px-3 py-2 w-full">
      <img src="https://upload.wikimedia.org/wikipedia/commons/3/32/Flag_of_Pakistan.svg" alt="Pakistan Flag"
        class="w-6 h-4 mr-2">
      <span id="countryCode" class="text-gray-700 mr-1">+92</span>
      <input type="tel" placeholder="Phone Number" class="outline-none flex-1" id="phoneInput">
    </div>

    <button class="bg-gray-600 text-white font-semibold px-6 py-2 rounded-md w-full transition">
      Continue
    </button>
  </div>
</body>

</html>