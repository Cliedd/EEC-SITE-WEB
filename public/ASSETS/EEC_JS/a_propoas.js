let index = 0;

function showSlide(n) {
  const carousel = document.getElementById('carousel');
  const slides = document.querySelectorAll('.slide');
  if (n >= slides.length) index = 0;
  if (n < 0) index = slides.length - 1;
  carousel.style.transform = `translateX(${-index * 100}%)`;
}

function nextSlide() {
  index++;
  showSlide(index);
}

function prevSlide() {
  index--;
  showSlide(index);
}