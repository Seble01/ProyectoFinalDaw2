function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}

window.addEventListener('scroll', function() {
  var scrollPosition = window.pageYOffset;

  if (scrollPosition > 200) {
    document.getElementById('scroll-top-btn').classList.add('show');
  } else {
    document.getElementById('scroll-top-btn').classList.remove('show');
  }
});