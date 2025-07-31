<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Ulang Tahun Cintaku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      color: white;
      background: linear-gradient(-45deg, #ffb6c1, #ff69b4, #dda0dd, #ff7eb3);
      background-size: 400% 400%;
      animation: gradientBG 10s ease infinite;
      overflow-x: hidden;
    }
    @keyframes gradientBG {
      0% {background-position:0% 50%;}
      50% {background-position:100% 50%;}
      100% {background-position:0% 50%;}
    }

    /* Balon */
    .balloon{
      position:fixed;bottom:-150px;width:40px;height:60px;border-radius:50% 50% 45% 45%;
      background:red;opacity:.9;z-index:2;animation:floatUp 6s linear forwards;
    }
    .balloon::before{content:'';position:absolute;bottom:-20px;left:50%;width:2px;height:20px;background:#fff;transform:translateX(-50%);}
    @keyframes floatUp{0%{transform:translateY(0) scale(1);opacity:1;}100%{transform:translateY(-120vh) scale(1.2);opacity:0;}}

    /* Hati terbang */
    .heart {
      position: fixed;
      color: rgba(255,192,203,0.8);
      font-size: 20px;
      animation: floatUp 8s linear forwards;
      z-index: 1;
    }

    /* Bokeh */
    .bokeh {
      position: fixed;
      top:0;left:0;
      width:100%;height:100%;
      z-index:0;
      overflow:hidden;
      pointer-events:none;
    }
    .bokeh span {
      position:absolute;
      display:block;
      width:20px;height:20px;
      border-radius:50%;
      background:rgba(255,255,255,0.2);
      animation: bokehAnim 10s linear infinite;
    }
    @keyframes bokehAnim {
      0% {transform:translateY(0) scale(1);}
      100% {transform:translateY(-100vh) scale(0.5);}
    }

    /* Konten utama */
    .content {
      opacity: 0;
      transform: scale(.8);
      transition: all 1s ease;
      margin-top: 150px;
      margin-bottom: 150px;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .judul span {
      display:inline-block;
      opacity:0;
      transform:translateY(-20px) scale(0.8);
    }
    #deskripsi {opacity:0;transform:translateY(20px);}

    /* Slideshow */
    .slideshow-container {
      position:relative;width:400px;height:400px;margin:40px auto;overflow:hidden;border-radius:50%;
      box-shadow:0 0 40px rgba(255,0,222,0.7);
    }
    .slide {
      position:absolute;top:0;left:100%;width:100%;height:100%;object-fit:cover;border-radius:50%;
      opacity:0;transform:scale(.9);transition:all 1s ease;
    }
    .slide.active {left:0;opacity:1;transform:scale(1);}
    .slide.prev {left:-100%;}
    .prev-btn,.next-btn {
      position:absolute;top:50%;transform:translateY(-50%);
      background:rgba(255,255,255,.7);border:none;font-size:2rem;padding:10px 20px;cursor:pointer;border-radius:50%;z-index:20;
    }
    .prev-btn:hover,.next-btn:hover{background:rgba(255,255,255,1);}
    .prev-btn{left:-60px;}.next-btn{right:-60px;}

    /* Amplop */
    .envelope-container {position:fixed;top:30px;right:30px;z-index:50;cursor:pointer;}
    .envelope {position:relative;width:80px;height:50px;background:#ffc0cb;border-radius:5px;
               box-shadow:0 5px 15px rgba(0,0,0,0.2);overflow:hidden;}
    .envelope .flap {
      position:absolute;top:0;left:0;width:0;height:0;
      border-left:40px solid transparent;border-right:40px solid transparent;
      border-bottom:25px solid #ff69b4;transform-origin:top center;transition:transform .5s ease;
    }
    .envelope.open .flap {transform:rotateX(180deg);}
    .envelope .letter {
      position:absolute;top:100%;left:5px;width:70px;height:40px;background:white;
      transition:top .5s ease .5s;border-radius:3px;
    }
    .envelope.open .letter {top:5px;}

    /* Popup kartu ucapan */
    .popup-card {
      position:fixed;top:50%;left:50%;transform:translate(-50%,-50%) scale(0.8);
      background:white;color:#ff69b4;padding:40px;border-radius:20px;
      box-shadow:0 5px 20px rgba(0,0,0,0.3);z-index:100;opacity:0;transition:all .5s ease;text-align:center;
      max-width:400px;
    }
    .popup-card.active {opacity:1;transform:translate(-50%,-50%) scale(1);}
    .popup-card h3 {font-weight:bold;margin-bottom:15px;}

    /* Artikel */
    .article-section {
      max-width:800px;margin:60px auto;padding:20px;background:rgba(255,255,255,0.15);
      border-radius:20px;box-shadow:0 5px 15px rgba(0,0,0,0.2);
    }
    .article-section img {
      width:100%;border-radius:15px;margin:20px 0;
      box-shadow:0 5px 15px rgba(0,0,0,0.3);
    }
    .btn-gallery {margin-top:50px;}
  </style>
</head>
<body>
  <audio id="musik" loop>
    <source src="{{ asset('music/romantis.mp3') }}" type="audio/mpeg">
  </audio>

  <!-- Bokeh -->
  <div class="bokeh" id="bokeh"></div>

  <!-- Amplop -->
  <div class="envelope-container" id="envelopeBtn">
    <div class="envelope" id="envelope">
      <div class="flap"></div>
      <div class="letter"></div>
    </div>
  </div>

  <!-- Popup kartu ucapan -->
  <div class="popup-card" id="popupCard">
    <h3>For My Love maaf yaa cuma bisa dari jauh</h3>
    <p>Selamat ulang tahun cintaku sayangku my baby❤️<br>Semoga selalu bahagia, sehat, sukses, daaan pastinyaa selalu sama aku selamanya.</p>
    <button class="btn btn-danger mt-3" id="closePopup">Tutup</button>
  </div>

  <!-- Konten -->
  <div class="content" id="content">
    <!-- Slideshow -->
    <div class="slideshow-container">
      @foreach($slideshow as $index => $foto)
        <img src="{{ asset($foto) }}" class="slide {{ $index===0?'active':'' }}">
      @endforeach
      <button class="prev-btn">&laquo;</button>
      <button class="next-btn">&raquo;</button>
    </div>

    <h1 class="judul mb-3" id="judul">
      Happy Birthday Sayang, Ghenia Sahila Khaerrusshidqi
    </h1>
    <p class="lead mb-4" id="deskripsi">
      Terima kasih karna udaa hadir di hidupku, memberi warna dan kebahagiaan yang tak ternilai. i love u more than u know sayang.
    </p>

    <a href="{{ url('/gallery') }}" class="btn btn-light btn-lg shadow btn-gallery">
      👉 Liat ini
    </a>

    <!-- GANTI HANYA BAGIAN INI DI DALAM <div class="article-section"> -->
<div class="article-section">
  <h2>Di baca yaa cantiku cintaku sayangku</h2>
  <p>
    Dari awal kita bertemu, dunia terasa berbeda. Saat itu, aku tidak pernah menyangka bahwa seseorang seperti kamu akan hadir di hidupku. 
    Setiap kata yang kita ucapkan, setiap tawa yang kita bagi, semua terasa begitu tulus dan nyata. Kamu bukan hanya sekadar orang yang lewat 
    dalam hidupku, kamu adalah bagian yang mengubah segalanya.
  </p>
  <p>
    Aku masih ingat hari pertama kita mengobrol panjang. Ada rasa canggung, ada rasa takut, tapi ada juga kehangatan yang tidak pernah aku rasakan sebelumnya.
    Waktu berlalu, namun setiap momen bersamamu terasa begitu cepat, seolah dunia tidak ingin memberi kita jeda untuk berhenti menikmati indahnya kebersamaan ini.
  </p>
  <p>
    Ada hari-hari di mana kita tertawa sampai lupa waktu, membicarakan hal-hal yang bahkan orang lain mungkin menganggapnya sepele, 
    tetapi bagiku, itu adalah hal yang luar biasa karena aku melakukannya bersamamu. Ada juga hari-hari di mana kita saling mendiamkan, 
    namun pada akhirnya selalu ada pelukan dan senyum yang menghapus semua kerikil kecil dalam perjalanan kita.
  </p>
  <p>
    Perjalanan kita bukan hanya tentang bahagia, tetapi juga tentang bertahan. Tentang bagaimana kita memilih untuk saling menggenggam tangan 
    saat badai datang, memilih untuk tetap saling memeluk meski dunia terasa berat. Kamu mengajariku arti kesabaran, arti mengalah, dan arti mencintai 
    tanpa syarat.
  </p>
  <p>
    Hari-hari bersamamu adalah mozaik indah yang membentuk satu gambar besar bernama "kita". Dan di setiap potongan kecil itu, aku menemukan diriku 
    yang berbeda, lebih baik, lebih penuh cinta. Kamu adalah rumah tempat aku pulang, tempat aku merasa aman, dan tempat aku bisa menjadi diriku sendiri 
    tanpa takut dihakimi.
  
    Ingatkah kamu saat kita pergi berjalan-jalan tanpa tujuan hanya untuk menikmati angin sore? Atau saat kita duduk di bawah langit malam, 
    menghitung bintang dan berandai-andai tentang masa depan? Semua itu bukan hanya memori; itu adalah bukti bahwa cinta kita nyata, sederhana, 
    namun sangat bermakna.
  </p>
  <p>
    Hari ini, di hari ulang tahunmu, aku hanya ingin kamu tahu satu hal: aku bersyukur setiap detik karena memilikimu. Aku bersyukur 
    kamu memilih untuk tetap tinggal di sisi ini, meskipun aku tidak sempurna. Dan aku bersyukur bahwa setiap cerita kita, sekecil apa pun itu, 
    akan terus menjadi bagian terindah dalam hidupku.
  
    Semoga kita terus menulis kisah yang panjang, kisah yang penuh dengan canda tawa, pelukan hangat, dan cinta tanpa akhir. 
    Semoga kita tidak pernah berhenti untuk saling memilih, saling mendukung, dan saling mencintai, meski dunia berubah dan waktu terus berjalan.
  </p>
  <p>
    Untukmu yang aku cintai, selamat ulang tahun. Terima kasih telah menjadi bagian terpenting dari hidupku. Aku mencintaimu, lebih dari 
    kata-kata, lebih dari waktu, dan lebih dari yang bisa kupahami. Selamat ulang tahun, sayangku.
  </p>
</div>


  <script>
    // Musik
    window.onload = () => document.getElementById('musik').play();

    // Hati terbang
    function createHeart(){
      const heart=document.createElement('div');
      heart.className='heart';
      heart.innerHTML='❤️';
      heart.style.left=Math.random()*window.innerWidth+'px';
      heart.style.fontSize=(Math.random()*20+10)+'px';
      document.body.appendChild(heart);
      setTimeout(()=>heart.remove(),8000);
    }
    setInterval(createHeart,500);

    // Balon terbang
    function createBalloon(){
      for(let i=0;i<3;i++){
        const balloon=document.createElement('div');
        balloon.classList.add('balloon');
        const colors=['#ff4d6d','#ff7eb3','#ffd166','#06d6a0','#118ab2','#073b4c'];
        balloon.style.background=colors[Math.floor(Math.random()*colors.length)];
        balloon.style.left=Math.random()*window.innerWidth+'px';
        const size=Math.random()*30+30;
        balloon.style.width=size+'px';
        balloon.style.height=size*1.5+'px';
        document.body.appendChild(balloon);
        setTimeout(()=>balloon.remove(),6000);
      }
    }
    setInterval(createBalloon,1000);

    // Bokeh
    const bokeh=document.getElementById('bokeh');
    for(let i=0;i<30;i++){
      const span=document.createElement('span');
      span.style.left=Math.random()*100+'%';
      span.style.top=Math.random()*100+'%';
      span.style.width=span.style.height=Math.random()*30+10+'px';
      span.style.animationDelay=Math.random()*10+'s';
      bokeh.appendChild(span);
    }

    // Slideshow
    const slides=document.querySelectorAll('.slide');
    let index=0,slideInterval;
    function showSlide(newIndex,dir=1){
      slides[index].classList.remove('active');
      slides[index].classList.add(dir===1?'prev':'');
      index=newIndex;
      slides[index].classList.add('active');
      setTimeout(()=>slides.forEach(s=>s.classList.remove('prev')),1000);
    }
    function nextSlide(){showSlide((index+1)%slides.length,1);}
    function prevSlide(){showSlide((index-1+slides.length)%slides.length,-1);}
    document.querySelector('.next-btn').addEventListener('click',()=>{nextSlide();resetInterval();});
    document.querySelector('.prev-btn').addEventListener('click',()=>{prevSlide();resetInterval();});
    function resetInterval(){clearInterval(slideInterval);slideInterval=setInterval(nextSlide,3000);}
    slideInterval=setInterval(nextSlide,3000);

    // Animasi teks
    const judul=document.getElementById('judul');
    const deskripsi=document.getElementById('deskripsi');
    judul.innerHTML=judul.textContent.split('').map(c=>`<span>${c}</span>`).join('');
    anime.timeline()
      .add({targets:'#judul span',opacity:[0,1],translateY:[-20,0],scale:[0.8,1],delay:anime.stagger(50),easing:'easeOutBack'})
      .add({targets:'#deskripsi',opacity:[0,1],translateY:[20,0],duration:1000,offset:'-=500',easing:'easeOutQuad'});
    document.getElementById('content').style.opacity=1;

    // Amplop animasi
    const envelope=document.getElementById('envelope');
    const envelopeBtn=document.getElementById('envelopeBtn');
    const popup=document.getElementById('popupCard');
    const closePopup=document.getElementById('closePopup');
    envelopeBtn.addEventListener('click',()=>{
      envelope.classList.add('open');
      setTimeout(()=>popup.classList.add('active'),1000);
    });
    closePopup.addEventListener('click',()=>{
      popup.classList.remove('active');
      envelope.classList.remove('open');
    });

    // Confetti
    setInterval(()=>confetti({particleCount:80,spread:70,origin:{y:0.6}}),2000);
  </script>
</body>
</html>
