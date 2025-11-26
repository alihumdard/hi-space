
  // Get query param
  const params = new URLSearchParams(window.location.search);
  const type = params.get('type'); // whatsapp, phone, email

  const phoneWrapper = document.getElementById('phoneWrapper');
  const phoneInput = document.getElementById('phoneInput');

  if (type === 'email') {
    // Email input style
    phoneWrapper.classList.remove('border-gray-300');
    phoneWrapper.classList.add('border-blue-500', 'bg-white');
    phoneInput.placeholder = "Email Address";
    phoneInput.type = "email";
  } else if (type === 'whatsapp') {
    phoneWrapper.classList.remove('border-gray-300');
    phoneWrapper.classList.add('bg-white', 'text-white');
    phoneInput.placeholder = "Phone Number";
    phoneInput.type = "tel";
  } else {
    // phone default
    phoneWrapper.classList.add('border-gray-300', 'bg-white');
    phoneInput.placeholder = "Phone Number";
    phoneInput.type = "tel";
  }
