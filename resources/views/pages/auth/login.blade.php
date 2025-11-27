<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Hi Space</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/assets/css/auth-style.css" />
  <style>
    /* Custom Disabled State */
    .disabled-option {
        opacity: 0.5;
        cursor: not-allowed;
        filter: grayscale(100%);
        pointer-events: none; /* Prevents clicking */
        user-select: none;
    }
    
    /* Active Option Animation */
    .active-option {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
    }
    
    .active-option:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(37, 211, 102, 0.4);
        border-color: #25D366;
    }

    /* Pulse Animation for the main CTA */
    @keyframes subtle-pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }
    
    .whatsapp-pulse {
        animation: subtle-pulse 2s infinite;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 font-sans py-12">
  <div class="flex flex-col w-full max-w-md p-8 bg-white rounded-3xl shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)] mx-4 border border-gray-100">
    
    <!-- Header Section -->
    <div class="text-center mb-10">
        <!-- Logo -->
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtDJH3bJ6iMGTd0ihphsXE2hpODMjLtWRoOw&s" onerror="this.style.display='none'" alt="Hi Space Logo" class="h-24 mx-auto mb-6 object-contain drop-shadow-sm">
        <h1 class="text-3xl text-gray-900 font-extrabold tracking-tight">Welcome Back</h1>
        <p class="text-gray-500 text-sm mt-2">Login to <span class="font-semibold text-gray-700">Hi Space</span> to continue</p>
    </div>

    <div class="flex flex-col space-y-4">
        
        <!-- OPTION 1: WhatsApp (Active & Highlighted) -->
        <a href="{{ route('password.otp.form') }}" class="active-option whatsapp-pulse flex items-center px-5 py-4 rounded-2xl cursor-pointer bg-white border border-green-100 shadow-sm group relative overflow-hidden">
            <!-- Green accent background -->
            <div class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="relative z-10 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4 shrink-0">
                <i class="fab fa-whatsapp text-3xl text-[#25D366]"></i>
            </div>
            <div class="relative z-10 flex-1">
                <h3 class="font-bold text-gray-800 text-lg">WhatsApp</h3>
                <p class="text-xs text-green-600 font-medium">Recommended (Fastest)</p>
            </div>
            <div class="relative z-10 bg-white rounded-full p-1 shadow-sm group-hover:bg-green-500 transition-colors">
                <i class="fas fa-arrow-right text-gray-300 group-hover:text-white text-sm w-5 h-5 flex items-center justify-center"></i>
            </div>
        </a>

        <!-- Divider -->
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-3 text-gray-400 tracking-wider">Other Options</span>
            </div>
        </div>

        <!-- OPTION 2: SMS (Disabled) -->
        <div class="disabled-option flex items-center px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 transition-opacity">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mr-4 shrink-0">
                <i class="fas fa-sms text-xl text-blue-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-400">SMS Login</h3>
                <p class="text-xs text-gray-400">Temporarily Unavailable</p>
            </div>
        </div>

        <!-- OPTION 3: Email (Disabled) -->
        <div class="disabled-option flex items-center px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 transition-opacity">
            <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mr-4 shrink-0">
                <i class="fas fa-envelope text-xl text-red-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-400">Email</h3>
                <p class="text-xs text-gray-400">Coming Soon</p>
            </div>
        </div>

        <!-- OPTION 4: Google (Disabled) -->
        <div class="disabled-option flex items-center px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 transition-opacity">
            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mr-4 shrink-0">
                <i class="fab fa-google text-xl text-gray-500"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-400">Google</h3>
                <p class="text-xs text-gray-400">Coming Soon</p>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="mt-10 text-center">
        <p class="text-xs text-gray-400">
            By continuing, you agree to our <a href="#" class="underline hover:text-gray-600 font-medium">Terms of Service</a> & <a href="#" class="underline hover:text-gray-600 font-medium">Privacy Policy</a>
        </p>
    </div>

  </div>
</body>
</html>