const slides = document.querySelector('.slides');
const slideImages = document.querySelectorAll('.slides img');

let counter = 1;
const slideWidth = slideImages[0].clientWidth;

setInterval(() => {
  slides.style.transition = 'transform 0.5s ease-in-out';
  slides.style.transform = `translateX(-${slideWidth * counter}px)`;
  counter++;

  if (counter === slideImages.length) {
    setTimeout(() => {
      slides.style.transition = 'none';
      slides.style.transform = 'translateX(0)';
      counter = 1;
    }, 1500);
  }
}, 1500);