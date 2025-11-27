<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verify Phone | Hi Space</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- International Telephone Input CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/assets/css/auth-style.css" />
  
  <style>
    /* Customizing the Intel Input to match Tailwind Theme */
    .iti {
        width: 100%;
        display: block;
    }
    
    .iti__flag {
        background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags.png");
    }

    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .iti__flag {
            background-image: url("https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/img/flags@2x.png");
        }
    }

    /* Smooth transitions for inputs */
    .input-group-focus:focus-within {
        border-color: #25D366;
        box-shadow: 0 0 0 4px rgba(37, 211, 102, 0.1);
    }

    /* Remove default border of the library to blend with our design */
    .iti__country-list {
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        font-family: sans-serif;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 font-sans py-12">
  <div class="flex flex-col w-full max-w-md p-8 bg-white rounded-3xl shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)] mx-4 border border-gray-100 relative">
    
    <!-- Back Button -->
    <a href="{{ route('login') }}" class="absolute top-6 left-6 text-gray-400 hover:text-gray-600 transition-colors">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>

    <!-- Header Section -->
    <div class="text-center mb-8 mt-2">
        <!-- Logo -->
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtDJH3bJ6iMGTd0ihphsXE2hpODMjLtWRoOw&s" onerror="this.style.display='none'" alt="Hi Space Logo" class="h-20 mx-auto mb-6 object-contain drop-shadow-sm">
        <h1 class="text-2xl text-gray-900 font-extrabold tracking-tight">Mobile Verification</h1>
        <p class="text-gray-500 text-sm mt-2">Enter your WhatsApp number to receive a 6-digit OTP</p>
    </div>

    <!-- OTP Request Form -->
    <form id="otpForm" action="{{ route('password.otp.verify') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Hidden input to store full number with country code -->
        <input type="hidden" name="full_phone" id="full_phone">

        <div class="space-y-2">
            <label for="phone" class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1">Phone Number</label>
            
            <!-- Phone Input Group -->
            <div class="input-group-focus bg-gray-50 border border-gray-200 rounded-2xl transition-all duration-200 overflow-hidden">
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone_raw" 
                    class="w-full bg-transparent border-none outline-none text-gray-800 font-semibold text-lg py-3.5 px-4 placeholder-gray-400"
                    placeholder="+9100 1234567"
                    required
                    autofocus
                >
            </div>
            <p class="text-xs text-gray-400 ml-1 pt-1">Select your country flag if it's not Pakistan.</p>
        </div>

        <!-- Action Button -->
        <button type="submit" class="w-full bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold py-4 rounded-2xl shadow-lg shadow-green-200 transform transition hover:-translate-y-0.5 flex items-center justify-center group">
            <span>Continue</span>
            <i class="fas fa-chevron-right ml-2 text-sm opacity-70 group-hover:translate-x-1 transition-transform"></i>
        </button>

    </form>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <p class="text-xs text-gray-400">
            Protected by reCAPTCHA and subject to the Google <a href="#" class="underline hover:text-gray-600">Privacy Policy</a> and <a href="#" class="underline hover:text-gray-600">Terms of Service</a>.
        </p>
    </div>

  </div>

  <!-- Scripts for Intl Tel Input -->
  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
  <script>
    // Initialize International Telephone Input
    const input = document.querySelector("#phone");
    const form = document.querySelector("#otpForm");
    const fullPhoneInput = document.querySelector("#full_phone");

    const iti = window.intlTelInput(input, {
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
      initialCountry: "pk", // Default country set to Pakistan
      separateDialCode: true, // Show +92 separate from input
      autoPlaceholder: "aggressive", // Show example number as placeholder
      preferredCountries: ["pk", "us", "gb", "ae", "sa"], // Put common countries at top
    });

    // Intercept Form Submission to get full number
    form.addEventListener('submit', function(e) {
        if (iti.isValidNumber()) {
            // Get the full number with country code (e.g., +923001234567)
            const fullNumber = iti.getNumber();
            fullPhoneInput.value = fullNumber;
        } else {
            // Optional: Prevent submit if invalid (or let backend handle it)
            // e.preventDefault();
            // alert('Please enter a valid number');
        }
    });
  </script>
</body>
</html>