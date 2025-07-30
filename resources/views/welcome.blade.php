<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Ulang Tahun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <style>
   html, body {
  margin: 0;
  padding: 0;
  min-height: 100vh; /* tetap penuh, tapi bisa scroll */
}
body {
  font-family: 'Segoe UI', sans-serif;
  color: white;
  background: linear-gradient(-45deg, #ff758c, #ff7eb3, #feb47b, #ff6a00);
  background-size: 400% 400%;
  animation: gradientBG 10s ease infinite;
  text-align: center;
}

    @keyframes gradientBG{0%{background-position:0% 50%;}50%{background-position:100% 50%;}100%{background-position:0% 50%;}}
    .start-screen{
      position:fixed;top:0;left:0;width:100%;height:100%;
      display:flex;flex-direction:column;justify-content:center;align-items:center;z-index:10;
      background:inherit;
    }
    .start-btn{
      width:150px;height:150px;border-radius:50%;
      background:radial-gradient(circle,#ff00de,#ff7eb3);border:none;color:white;
      font-size:2rem;font-weight:bold;cursor:pointer;box-shadow:0 0 20px rgba(255,0,222,.7);
      animation:pulse 1.5s infinite;
    }
    @keyframes pulse{0%{box-shadow:0 0 10px #ff00de,0 0 30px #ff7eb3;}50%{box-shadow:0 0 30px #ff00de,0 0 60px #ff7eb3;}100%{box-shadow:0 0 10px #ff00de,0 0 30px #ff7eb3;}}
    .flash{position:fixed;top:0;left:0;width:100%;height:100%;background:white;opacity:0;z-index:5;pointer-events:none;}
   .content {
  opacity: 0;
  pointer-events: none;
  transform: scale(.8);
  transition: all 1s ease;
  z-index: 2;
  margin-top: 200px;   /* Tambahkan jarak di atas */
  margin-bottom: 200px; /* Sudah ada jarak bawah */
}


.content a.btn {
  margin-bottom: 60px; /* hanya tombol bawah */
}

    .slideshow-container{position:relative;width:400px;height:400px;margin:40px auto;overflow:hidden;border-radius:50%;}
    .slide{
      position:absolute;top:0;left:100%;width:100%;height:100%;object-fit:cover;border-radius:50%;
      border:10px solid rgba(255,255,255,0.3);box-shadow:0 0 30px rgba(255,0,222,0.7);opacity:0;transform:scale(.9);
      transition:all 1s ease;
    }
    .slide.active{left:0;opacity:1;transform:scale(1);}
    .slide.prev{left:-100%;}
    .judul{font-size:3rem;font-weight:bold;text-shadow:0 0 20px #fff,0 0 40px #ff00de;animation:neon 1.5s ease-in-out infinite alternate;}
    @keyframes neon{from{text-shadow:0 0 5px #fff,0 0 10px #ff00de,0 0 20px #ff00de;}to{text-shadow:0 0 20px #fff,0 0 30px #ff00de,0 0 40px #ff00de;}}
    .prev-btn,.next-btn{
      position:absolute;top:50%;transform:translateY(-50%);
      background:rgba(255,255,255,.7);border:none;font-size:2rem;padding:10px 20px;cursor:pointer;border-radius:50%;z-index:20;
    }
    .prev-btn:hover,.next-btn:hover{background:rgba(255,255,255,1);}
    .prev-btn{left:-60px;}.next-btn{right:-60px;}
    .balloon{
      position:fixed;bottom:-150px;width:40px;height:60px;border-radius:50% 50% 45% 45%;
      background:red;opacity:.9;z-index:9;animation:floatUp 6s linear forwards;
    }
    .balloon::before{content:'';position:absolute;bottom:-20px;left:50%;width:2px;height:20px;background:#fff;transform:translateX(-50%);}
    @keyframes floatUp{0%{transform:translateY(0) scale(1);opacity:1;}100%{transform:translateY(-120vh) scale(1.2);opacity:0;}}
  </style>
</head>
<body>
  <audio id="musik" loop>
    <source src="{{ asset('music/happy.mp3') }}" type="audio/mpeg">
  </audio>

  <div class="start-screen" id="startScreen">
    <button id="startBtn" class="start-btn">START</button>
  </div>
  <div class="flash" id="flash"></div>

  <div class="content" id="content">
    <div class="slideshow-container">
      @foreach($slideshow as $index => $foto)
        <img src="{{ asset($foto) }}" class="slide {{ $index===0?'active':'' }}">
      @endforeach
      <button class="prev-btn">&laquo;</button>
      <button class="next-btn">&raquo;</button>
    </div>
    <h1 class="judul mb-3" id="judul">Happy Birthday to my favorit woman after my mom, yeesss uuu Ghenia Sahila Khaerrusshidqi</h1>
    <p class="lead mb-4">Semoga panjang umur, di permudah rezekinya, tidaaa males malesan tidaaa marahin aku teyusss dan selalu bahagia samaa akuu yaaa!</p>
    <a href="{{ url('/gallery') }}" class="btn btn-light btn-lg shadow">
  👉 Pencet ini coba
</a>

  </div>

  <script>
    const slides = document.querySelectorAll('.slide');
    const audio = document.getElementById('musik');
    const startBtn = document.getElementById('startBtn');
    const startScreen = document.getElementById('startScreen');
    const flash = document.getElementById('flash');
    const content = document.getElementById('content');
    let index = 0;
    let slideInterval;

    function showSlide(newIndex, direction=1){
      slides[index].classList.remove('active');
      slides[index].classList.add(direction===1?'prev':'');
      index=newIndex;
      slides[index].classList.add('active');
      setTimeout(()=>slides.forEach(s=>s.classList.remove('prev')),1000);
    }
    function nextSlide(){ showSlide((index+1)%slides.length,1); }
    function prevSlide(){ showSlide((index-1+slides.length)%slides.length,-1); }
    document.querySelector('.next-btn').addEventListener('click',()=>{nextSlide();resetInterval();});
    document.querySelector('.prev-btn').addEventListener('click',()=>{prevSlide();resetInterval();});
    function resetInterval(){ clearInterval(slideInterval); slideInterval=setInterval(nextSlide,3000); }

    function createBalloon(){
      for(let i=0;i<5;i++){ // buat 5 balon sekaligus
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

    startBtn.addEventListener('click',()=>{
      anime({targets:startBtn,scale:[1,0],rotate:'1turn',opacity:[1,0],duration:1000,easing:'easeInOutQuad',
        complete:()=>{
          startScreen.style.display='none';
          flash.style.opacity=1;
          setTimeout(()=>{
            flash.style.transition='opacity 1s ease'; flash.style.opacity=0;
            content.style.opacity=1; content.style.pointerEvents='auto'; content.style.transform='scale(1)';
            audio.play();
            slideInterval=setInterval(nextSlide,3000);
            anime({targets:'#judul',translateY:[-50,0],opacity:[0,1],scale:[0.5,1],easing:'easeOutElastic(1,.8)',duration:2000});
            setInterval(()=>confetti({particleCount:100,spread:70,origin:{y:0.6}}),1500);
            setInterval(createBalloon,1000);
          },300);
        }
      });
    });
  </script>
</body>
</html>
