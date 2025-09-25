// Carousel functionality for home page
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (!slides.length || !prevBtn || !nextBtn) return;
    
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        // Remove active class from all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', () => {
        nextSlide();
        stopSlideShow();
        startSlideShow();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        stopSlideShow();
        startSlideShow();
    });

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            stopSlideShow();
            startSlideShow();
        });
    });

    // Pause on hover
    const carousel = document.querySelector('.carousel-wrapper');
    if (carousel) {
        carousel.addEventListener('mouseenter', stopSlideShow);
        carousel.addEventListener('mouseleave', startSlideShow);
    }

    // Start the slideshow
    startSlideShow();
});
