<?php
include('connections.php');
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email']; 

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connections, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $account_type = $row['account_type'];
        $name = $row['name'];
        $email = $row['email'];
        $photo = 'https://hr3.restandfeast.store/' . $row['photo'];
        $position = $row['position'];
        $phone = $row['phone'];
        $lastname = $row['lastname'];
        $user_id = $row['id'];
        $created_at = $row['created_at'];
        $updated_at = $row['updated_at'];
        $otpfromdatabase = $row['otp'];
    } else {
        echo "No user found";
        exit;
    }
} else {
    echo "User not logged in.";
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['loginverify'])){
    $otp = $_POST['otp'];

    if($otp == $otpfromdatabase){
      if($account_type == 1){
        echo "<script>window.location.href='admin.php';</script>";
      }
      else{
         echo "<script>window.location.href='dashboard.php';</script>";
      }
    }
  }
  else{
    echo "<script>alert('Wrong OTP');</script>";

  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
     <title>FINANCIAL</title>
</head>
<body>
  <section class="w-full min-h-screen flex justify-center items-center bg-blue-950 p-4">
    <div class="bg-slate-200 shadow-md max-md:w-full w-1/2 min-h-96 rounded-lg flex max-md:flex-col">
        <!-- left side -->
        <div class="w-1/3 max-md:rounded-none max-md:p-4 max-md:w-full bg-sky-900 p-2 flex justify-center items-center flex-col gap-4">
            <img class="rounded-md w-40 h-40 shadow-md" src="images/logo.png" alt="Logo">
            <h1 class="font-bold text-lg text-white max-md:text-2xl">Rest & Feast</h1>
        </div>

        <!-- right side -->
        <div class="flex-1 flex justify-center items-center flex-col max-md:w-full">
            <div class="text-center max-md:mt-5">
                <h1 class="font-bold text-2xl text-black">Sign - In</h1>
            </div>
            <form autocomplete="off" class="p-4 w-full" method="post" action="loginotp.php">
        
        <div class="relative z-0 group">
          <label class="block text-sm font-medium text-gray-700 mb-3">Enter verification code</label>
          
          <!-- OTP input boxes -->
          <div class="flex justify-center mb-4 space-x-2">
            <input type="text" maxlength="1" class="w-10 h-12 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            <input type="text" maxlength="1" class="w-10 h-12 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            <input type="text" maxlength="1" class="w-10 h-12 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            <input type="text" maxlength="1" class="w-10 h-12 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            <input type="text" maxlength="1" class="w-10 h-12 text-center text-lg font-semibold border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          
          <!-- Hidden input to store the combined OTP value -->
          <input type="hidden" name="otp" id="otp">
          
          <!-- Static Error/Success Messages -->
        
          
        </div>
        
        <div class="flex items-center justify-between mt-6 mb-6">
          <a href="/resendOTP" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm transition duration-150 ease-in-out flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Resend OTP
          </a>
          <span id="countdown" class="text-gray-500 font-medium text-sm">01:30</span>
        </div>
        
        <div class="w-full">
          <button name="loginverify" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 transition duration-150 ease-in-out">Verify Code</button>
        </div>
        
      </form>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
  const inputs = document.querySelectorAll('input[maxlength="1"]');
  const hiddenInput = document.getElementById('otp');
  
  // Function to update the hidden input with all values
  const updateHiddenInput = () => {
    const otpValue = Array.from(inputs).map(input => input.value).join('');
    hiddenInput.value = otpValue;
  };
  
  // Add event listeners to each input
  inputs.forEach((input, index) => {
    // Move to next input after entering a digit
    input.addEventListener('input', () => {
      if (input.value.length === 1) {
        updateHiddenInput();
        if (inputs[index + 1]) {
          inputs[index + 1].focus();
        }
      }
    });
    
    // Handle backspace
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && !input.value && inputs[index - 1]) {
        inputs[index - 1].focus();
      }
    });
  });
  
  // Countdown timer with localStorage persistence
  const countdownEl = document.getElementById('countdown');
  let timeLeft;
  let countdownInterval;
  
  // Get the expiration timestamp from localStorage or create a new one
  let expirationTime = localStorage.getItem('otpExpirationTime');
  const totalSeconds = 90; // 1:30
  
  // If no stored time or it's expired, set a new one
  if (!expirationTime || new Date().getTime() > parseInt(expirationTime)) {
    expirationTime = new Date().getTime() + (totalSeconds * 1000);
    localStorage.setItem('otpExpirationTime', expirationTime);
  }
  
  const updateCountdown = () => {
    const currentTime = new Date().getTime();
    timeLeft = Math.max(0, Math.floor((parseInt(expirationTime) - currentTime) / 1000));
    
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    if (timeLeft <= 0) {
      clearInterval(countdownInterval);
      countdownEl.textContent = '00:00';
      localStorage.removeItem('otpExpirationTime'); // Clear the expired time
      window.location.href = "/OTPExpired";
    }
  };
  
  // Set up and start the countdown
  updateCountdown();
  countdownInterval = setInterval(updateCountdown, 1000);
  
  // Clear timer when user successfully submits OTP (add this to your form submission handler)
  // document.getElementById('otpForm').addEventListener('submit', () => {
  //   localStorage.removeItem('otpExpirationTime');
  // });
});
</script>
</body>
</html>