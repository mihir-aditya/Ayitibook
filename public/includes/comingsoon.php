<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coming Soon</title>
  <!-- Add this in <head> BEFORE using icons -->
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" >
    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Orbitron:wght@600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 60px 0;
      font-family: 'Playfair Display', serif;
      background: url('../assets/images/pages/bg.png') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
      color: #000;
    }

    .container {
      width: 100%;
      max-width: 850px;
      padding: 20px;
      position: relative;
    }
    
    /* Logo */
    .logo {
      position: fixed;
      top: 17px;
      left: 25px;
    }
    .logo img {
      width: 150px;
      height: auto;
      border-radius: 12px;
    }

    h1 {
      font-size: 2.3rem;
      margin: 20px 0 10px;
    }

    p {
      font-size: 1rem;
      margin-bottom: 30px;
      line-height: 1.6;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Countdown */
    .countdown {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .time-group {
      text-align: center;
    }

    .digits {
      display: flex;
      gap: 6px;
      justify-content: center;
    }

    .digit {
      background: #2d2d2d;
      color: #fff;
      font-size: 2.2rem;
      font-weight: bold;
      font-family: 'Orbitron', sans-serif;
      width: 50px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }

    .label {
      margin-top: 6px;
      font-size: 0.8rem;
      color: #333;
      font-weight: bold;
    }

    /* Button */
    .notify-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 25px;
      font-size: 1rem;
      background: white;
      font-weight: 700; /* bold */
      color: #007BFF;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      margin-top: 15px;
      transition: background 0.3s ease;
    }
    .notify-btn i {
      font-size: 1.2rem;
    }
    .notify-btn:hover {
      background: #007BFF; /* #8a385c with translucent effect */
      transform: translateY(-2px);
      color: #fff;
    }

    /* Social Icons */
    .social-icons {
      margin-top: 20px;
    }
    .social-icons a {
      margin: 0 12px;
      text-decoration: none;
      color: #000;
      font-size: 22px;
      transition: 0.3s;
    }
    .social-icons a:hover {
      color: #007BFF;
    }

    /* Responsive */
    @media (max-width: 600px) {
      h1 {
        font-size: 1.7rem;
      }
      .digit {
        width: 40px;
        height: 55px;
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- Logo -->
    <div class="logo">
      <img src="../assets/images/logo/logo-main.jpg" alt="Logo">
    </div>

    <!-- Emoji -->
    <div style="font-size: 6rem; margin-bottom:10px;">🤯</div>

    <!-- Heading -->
    <h1>We are creating awesome stuff for you.</h1>
    <p>
      Behind this page, magic is still being woven ✨<br>
      — our little code wizards are working overtime 👨‍💻, so sit tight and get ready for the sparkle soon 💫🚀.
    </p>

    <!-- Countdown -->
    <div class="countdown">
      <div class="time-group">
        <div class="digits">
          <div class="digit" id="day1">0</div>
          <div class="digit" id="day2">0</div>
        </div>
        <div class="label">DAYS</div>
      </div>
      <div class="time-group">
        <div class="digits">
          <div class="digit" id="hour1">0</div>
          <div class="digit" id="hour2">0</div>
        </div>
        <div class="label">HOURS</div>
      </div>
      <div class="time-group">
        <div class="digits">
          <div class="digit" id="min1">0</div>
          <div class="digit" id="min2">0</div>
        </div>
        <div class="label">MINUTES</div>
      </div>
      <div class="time-group">
        <div class="digits">
          <div class="digit" id="sec1">0</div>
          <div class="digit" id="sec2">0</div>
        </div>
        <div class="label">SECONDS</div>
      </div>
    </div>

    <!-- Button -->
    <button class="notify-btn"><i class="fa-solid fa-bell"></i> Notify me</button>
    <!-- Social Icons -->
    <div class="social-icons">
      <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="#"><i class="fa-brands fa-twitter"></i></a>
      <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </div>

  </div>

  

  <!-- Countdown Timer -->
  <script>
    // Set target date (10 days from now)
    var countDownDate = new Date().getTime() + (10 * 24 * 60 * 60 * 1000);

    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = countDownDate - now;

      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      function pad2(n) { return n < 10 ? "0" + n : "" + n; }

      var d = pad2(days), h = pad2(hours), m = pad2(minutes), s = pad2(seconds);

      document.getElementById("day1").innerText = d[0];
      document.getElementById("day2").innerText = d[1];
      document.getElementById("hour1").innerText = h[0];
      document.getElementById("hour2").innerText = h[1];
      document.getElementById("min1").innerText = m[0];
      document.getElementById("min2").innerText = m[1];
      document.getElementById("sec1").innerText = s[0];
      document.getElementById("sec2").innerText = s[1];

      if (distance < 0) {
        clearInterval(x);
        document.querySelector(".countdown").innerHTML = "<h2>We're Live!</h2>";
      }
    }, 1000);
  </script>
</body>
</html>
