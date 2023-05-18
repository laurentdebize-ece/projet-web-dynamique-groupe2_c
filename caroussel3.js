const carousel = document.querySelector('.carousel');
const carouselList = carousel.querySelector('ul');
const carouselItems = carousel.querySelectorAll('li');
const prevButton = carousel.querySelector('.prev');
const nextButton = carousel.querySelector('.next');

let currentPosition = 0;

prevButton.addEventListener('click', () => {
  if (currentPosition > 0) {
    currentPosition -= 3;
    carouselList.style.transform = `translateX(-${currentPosition}00%)`;
  }
});

nextButton.addEventListener('click', () => {
  if (currentPosition < carouselItems.length - 3) {
    currentPosition += 3;
    carouselList.style.transform = `translateX(-${currentPosition}00%)`;
  }
});
