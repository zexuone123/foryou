<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I Love U So Much Babe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #ff758c, #ff7eb3);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      overflow-x: hidden;
      position: relative;
    }
    .judul {
      font-size: 3rem;
      font-weight: bold;
      background: linear-gradient(45deg,#fff,#ffe6f0,#ffb6c1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 0 20px rgba(255,255,255,0.5);
      animation: glow 2s ease-in-out infinite alternate;
    }
    @keyframes glow {
      0% { text-shadow: 0 0 10px #fff, 0 0 20px #ffb6c1; }
      100% { text-shadow: 0 0 20px #fff, 0 0 40px #ff4d79; }
    }
    .foto-item {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  opacity: 0;
  transform: translate3d(0,0,0) rotate(-2deg);
  transition: transform 0.4s ease;
  animation: float3d 6s ease-in-out infinite;
}

/* Animasi 3D floating */
@keyframes float3d {
  0%   { transform: translate3d(0,0,0) rotate(-2deg) scale(1); }
  25%  { transform: translate3d(5px,-10px,5px) rotate(2deg) scale(1.03); }
  50%  { transform: translate3d(-5px,5px,-5px) rotate(-1deg) scale(0.98); }
  75%  { transform: translate3d(8px,0,3px) rotate(3deg) scale(1.02); }
  100% { transform: translate3d(0,0,0) rotate(-2deg) scale(1); }
}

    /* Floating hearts background */
    .heart {
      position: fixed;
      width: 20px;
      height: 20px;
      background: red;
      transform: rotate(45deg);
      animation: floatUp 8s linear infinite;
      opacity: 0.7;
      z-index: 0;
    }
    .heart::before,
    .heart::after {
      content: "";
      position: absolute;
      width: 20px;
      height: 20px;
      background: red;
      border-radius: 50%;
    }
    .heart::before { top: -10px; left: 0; }
    .heart::after { top: 0; left: -10px; }
    @keyframes floatUp {
      0% { transform: translateY(100vh) rotate(45deg) scale(0.8); opacity:1; }
      100% { transform: translateY(-20vh) rotate(45deg) scale(1.5); opacity:0; }
    }
  </style>
</head>
<body>
  <!-- Floating Hearts -->
  <div id="hearts"></div>

  <div class="container py-5 text-center position-relative" style="z-index:1;">
    <h1 class="judul mb-4" id="judul">I Love U So Much and more than u know Babe</h1>
    
    <div class="row g-4" id="galeri">
      @foreach($images as $img)
        <div class="col-6 col-md-4 col-lg-3">
          <img src="{{ asset($img) }}" class="foto-item">
        </div>
      @endforeach
    </div>
  </div>

  <script>
    // Animasi foto
    anime({
      targets: '.foto-item',
      opacity: [0,1],
      scale: [0.8,1],
      rotate: [-5,0],
      delay: anime.stagger(100),
      easing: 'easeOutQuad'
    });

    // Animasi judul
    anime({
      targets: '#judul',
      translateY: [-50,0],
      opacity: [0,1],
      scale: [0.5,1],
      easing: 'easeOutElastic(1,.8)',
      duration: 2000
    });

    document.querySelectorAll('.foto-item').forEach((img, index) => {
  img.style.animationDelay = (Math.random() * 2) + 's';
});


    // Floating hearts
    function createHeart(){
      const heart = document.createElement('div');
      heart.className = 'heart';
      heart.style.left = Math.random() * window.innerWidth + 'px';
      heart.style.background = ['#ff4d6d','#ff7eb3','#ffb6c1','#ff4d79'][Math.floor(Math.random()*4)];
      document.getElementById('hearts').appendChild(heart);
      setTimeout(()=>heart.remove(),8000);
    }
    setInterval(createHeart, 400);
  </script>

  <a href="{{ url('/') }}" class="btn btn-light mb-4 shadow-lg">👉 Balik lagii</a>
</body>
</html>
