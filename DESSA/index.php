<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fresh Fruits</title>
  <style>
    /* --- Base Reset --- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    body {
      background: #fffaf2;
      color: #333;
      overflow-x: hidden;
    }

    /* --- Header --- */
     header {
    background: linear-gradient(135deg, #ff7b00, #ffbb00);
    color: white;
    display: flex;
    justify-content: space-between; /* spreads logo and button apart */
    align-items: center;
    padding: 1em 3em; /* increased horizontal padding */
    font-size: 1.5em;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    letter-spacing: 1px;
    position: sticky;
    top: 0;
    z-index: 999;
     gap: 1.2em;
  }
/* --- Logout Button --- */
.logout-btn {
  background: linear-gradient(135deg, #ff4b2b, #ff9068);
  color: white;
  border: none;
  padding: 0.6em 1.4em;
  border-radius: 30px;
  font-weight: 600;
  cursor: pointer;
  font-size: 0.9em;
  transition: all 0.4s ease;
  box-shadow: 0 0 10px rgba(255,107,53,0.4);
}

.logout-btn:hover {
  background: linear-gradient(135deg, #ff9068, #ff4b2b);
  transform: scale(1.08) rotate(-1deg);
  box-shadow: 0 0 25px rgba(255,107,53,0.7);
}

.logout-btn:active {
  transform: scale(0.95);
}
  .logo {
    display: flex;
    align-items: center;
    gap: 0.6em; /* creates spacing between emojis and text */
  }

  .logo span {
    font-size: 1.3em;
  }

  /* --- Sign Up Button --- */
  .signup-btn {
    background: linear-gradient(135deg, #ff7b00, #ffd56a);
    color: white;
    border: none;
    padding: 0.6em 1.4em;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.9em;
    transition: all 0.4s ease;
    box-shadow: 0 0 10px rgba(255,193,7,0.4);
    margin-left: 2em; /* gap between logo and button */
  }

  .signup-btn:hover {
    background: linear-gradient(135deg, #ffd56a, #ff7b00);
    transform: scale(1.08);
    box-shadow: 0 0 25px rgba(255,193,7,0.7);
  }

  .signup-btn:active {
    transform: scale(0.97);
  }

  /* Responsive: stack items nicely on mobile */
  @media (max-width: 768px) {
    header {
      flex-direction: column;
      gap: 1em;
      text-align: center;
    }
  }

    /* --- Navigation --- */
    nav {
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2em;
      padding: 1em;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      position: sticky;
      top: 70px;
      z-index: 998;
    }

    nav a {
      text-decoration: none;
      color: #ff7b00;
      font-weight: 600;
      padding: 0.5em 1em;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    nav a:hover {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: white;
      transform: scale(1.1);
    }

    /* --- Hero Section --- */
    .hero {
      text-align: center;
      padding: 5em 1em;
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), 
        url('BASKETS.webp') center/cover no-repeat;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 80vh;
    }

    .hero h1 {
      font-size: 3em;
      background: rgba(0,0,0,0.4);
      padding: 0.5em 1.5em;
      border-radius: 15px;
      animation: fadeInUp 1.2s ease;
    }

    .hero p {
      margin-top: 1em;
      font-size: 1.2em;
      color: #ffe9c7;
      animation: fadeInUp 1.6s ease;
    }

    .hero .btn {
      margin-top: 2em;
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: white;
      padding: 0.8em 2em;
      border: none;
      border-radius: 50px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      animation: fadeInUp 2s ease;
    }

    .hero .btn:hover {
      transform: scale(1.1);
      box-shadow: 0 0 20px rgba(255,193,7,0.5);
    }

    /* --- About Section --- */
    .about {
      padding: 4em 1.5em;
      text-align: center;
      background: #fff8f0;
    }

    .about h2 {
      color: #ff7b00;
      font-size: 2em;
      margin-bottom: 1em;
      position: relative;
    }

    .about h2::after {
      content: "";
      display: block;
      width: 80px;
      height: 4px;
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      margin: 0.5em auto 1em;
      border-radius: 10px;
    }

    .about p {
      max-width: 700px;
      margin: auto;
      color: #555;
      font-size: 1.1em;
      line-height: 1.8em;
    }

    /* --- Gallery Section --- */
    .gallery {
      padding: 4em 2em;
      background: #ffffff;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2em;
    }

    .fruit-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      opacity: 0;
      transform: translateY(40px);
    }

    .fruit-card.visible {
      opacity: 1;
      transform: translateY(0);
      transition: 0.6s ease all;
    }

    .fruit-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .fruit-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .fruit-card:hover img {
      transform: scale(1.1);
    }

    .fruit-card h3 {
      color: #ff7b00;
      font-size: 1.4em;
      padding: 1em;
    }

    .fruit-card p {
      padding: 0 1.2em 1.5em;
      color: #555;
      line-height: 1.6em;
      font-size: 0.95em;
    }

    /* --- Footer --- */
    footer {
      text-align: center;
      padding: 2em;
      background: linear-gradient(135deg, #ff7b00, #ffbb00);
      color: white;
      font-size: 0.95em;
      margin-top: 2em;
    }

    footer span {
      font-weight: bold;
    }

    /* --- Animations --- */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* --- Responsive --- */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        gap: 1em;
      }
      .hero h1 {
        font-size: 2.2em;
      }
      nav {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>
  <header>
  <div class="logo">
    🍓 <span>Fresh Fruits Paradise</span> 🍍
  </div>
  <div class="header-buttons">
    <button class="signup-btn" onclick="window.location.href='signup.php'">Sign Up</button>
    <button class="logout-btn" onclick="logoutUser()">Logout</button>
  </div>
</header>

  
  <nav>
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#gallery">Fruits</a>
  </nav>

  <section class="hero" id="home">
    <h1>Eat Fresh, Live Healthy!</h1>
    <p>Discover nature’s sweetest and most colorful creations.</p>
    <button class="btn" onclick="exploreFruits()">Explore Fruits</button>
  </section>

  <section class="about" id="about">
    <h2>About Us</h2>
    <p>
      Welcome to <b>Fresh Fruits Paradise</b> — where we believe health begins 
      with what you eat. Our fruits are handpicked from the best farms to ensure 
      freshness, quality, and natural goodness in every bite.  
      We promote sustainable and eco-friendly farming to protect our planet.
    </p>
  </section>

  <section class="gallery" id="gallery">
    <div class="fruit-card">
      <img src="BANNA.jfif" alt="Banana">
      <h3>Banana</h3>
      <p>Rich in potassium, boosts energy, and helps maintain strong muscles.</p>
    </div>
    <div class="fruit-card">
      <img src="APPLE.jfif" alt="Apple">
      <h3>Apple</h3>
      <p>Crunchy, sweet, and full of fiber — a perfect healthy snack anytime.</p>
    </div>
    <div class="fruit-card">
      <img src="ORANGE.jfif" alt="Orange">
      <h3>Orange</h3>
      <p>Packed with Vitamin C for glowing skin and a strong immune system.</p>
    </div>
    <div class="fruit-card">
      <img src="MANGO.webp" alt="Mango">
      <h3>Mango</h3>
      <p>Sweet, tropical, and refreshing — the king of fruits!</p>
    </div>
    <div class="fruit-card">
      <img src="WATERMELON.jfif" alt="Watermelon">
      <h3>Watermelon</h3>
      <p>Hydrating and juicy — the perfect fruit for hot summer days.</p>
    </div>
  </section>

  <footer>
    © 2025 <span>Fresh Fruits Paradise</span> | Made with 🍉 and ☀️
  </footer>
<script>
  function logoutUser() {
    // Simple confirmation before logout
    if (confirm("Are you sure you want to log out? 🍊")) {
      // Optional: clear session using AJAX or redirect to logout.php
      window.location.href = 'logout.php';
    }
  }
</script>
<script>
  function exploreFruits() {
    const gallery = document.getElementById('gallery');
    gallery.scrollIntoView({ behavior: 'smooth' });

    // temporary glow highlight
    gallery.style.transition = 'box-shadow 0.8s ease';
    gallery.style.boxShadow = '0 0 40px rgba(255,193,7,0.6)';
    setTimeout(() => {
      gallery.style.boxShadow = 'none';
    }, 1200);
  }
</script>

  <script>
    // Fade-in effect on scroll
    const cards = document.querySelectorAll('.fruit-card');
    const revealOnScroll = () => {
      const triggerBottom = window.innerHeight * 0.85;
      cards.forEach(card => {
        const cardTop = card.getBoundingClientRect().top;
        if (cardTop < triggerBottom) {
          card.classList.add('visible');
        }
      });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();
  </script>
</body>
</html>
