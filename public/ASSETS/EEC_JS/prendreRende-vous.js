(function(){
  const slides = Array.from(document.querySelectorAll('.slide'));
  const prevBtn = document.getElementById('prev');
  const nextBtn = document.getElementById('next');
  let current = 0;
  let interval = null;
  const AUTO_MS = 6000;

  function show(i){
    slides.forEach((s,idx)=>{
      s.classList.toggle('active', idx===i);
    });
    current=i;
  }

  function next(){
    show((current+1)%slides.length);
  }
  function prev(){
    show((current-1+slides.length)%slides.length);
  }

  function startAuto(){
    stopAuto();
    interval=setInterval(next,AUTO_MS);
  }
  function stopAuto(){
    if(interval){clearInterval(interval);interval=null;}
  }

  show(0);
  startAuto();

  nextBtn.onclick=()=>{next();startAuto();}
  prevBtn.onclick=()=>{prev();startAuto();}
})();
