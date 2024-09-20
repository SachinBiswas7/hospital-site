let slideIndex = 0;
const slides = document.querySelectorAll('.slider img');
const totalSlides = slides.length;

function showSlides() {
    slides.forEach(slide => {
        slide.style.display = 'none';
    });
    slideIndex++;
    if (slideIndex > totalSlides) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = 'block';
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}

showSlides();
