const carousel = document.querySelector('.carousel');
const prevBtn = document.querySelector('.carousel-prev');
const nextBtn = document.querySelector('.carousel-next');
const images = document.querySelectorAll('.carousel img');

let currentIndex = 0;

function showImage(index) {
  if (index < 0) {
    index = images.length - 1;
  } else if (index >= images.length) {
    index = 0;
  }
  
  carousel.style.transform = `translateX(-${index * 100}%)`;
  currentIndex = index;
}

prevBtn.addEventListener('click', function() {
  showImage(currentIndex - 1);
});

nextBtn.addEventListener('click', function() {
  showImage(currentIndex + 1);
});

showImage(currentIndex);
