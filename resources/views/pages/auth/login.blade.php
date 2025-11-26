<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/assets/css/auth-style.css" />
</head>

<body class="h-screen flex items-center justify-center bg-white">
  <div class="flex flex-col space-y-4 w-80">
    <h1 class="text-2xl text-gray-600 text-center font-bold">Login With</h1>
    <!-- WhatsApp style input -->
    <a class="flex items-center px-3 py-2 rounded-md cursor-pointer bg-white border border-gray-300 text-white"
      href="{{route('password.otp.form')}}">
      <i class="fab fa-whatsapp mr-2" style="color: green;font-size: 30px;"></i>
      <input type="text" placeholder="WhatsApp" class="outline-none text-black flex-1" readonly>
    </a>

    <!-- Phone number style input -->
    <div class="flex items-center px-3 py-2 rounded-md cursor-pointer border border-gray-300"
      onclick="#">
      <i class="fas fa-phone mr-2" style="color: skyblue;font-size: 20px;"></i>
      <input type="text" placeholder="Phone Number" class="outline-none flex-1" readonly>
    </div>

    <!-- Email style input -->
    <div class="flex items-center px-3 py-2 rounded-md cursor-pointer border border-gray-300"
      onclick="#">
      <i class="fas fa-envelope mr-2" style="color: red;font-size: 25px;"></i>
      <input type="text" placeholder="Email Address" class="outline-none flex-1" readonly>
    </div>
  </div>
</body>

</html>