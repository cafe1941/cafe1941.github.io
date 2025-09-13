// Smooth cubic-bezier animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

// Remove map animation - show everything immediately

// Parallax Animation for About Items based on scroll
const aboutItems = document.querySelectorAll('.about-item');

function updateAboutParallax() {
    aboutItems.forEach((item, index) => {
        const rect = item.getBoundingClientRect();
        const bgImage = item.querySelector('.about-bg-image');

        if (bgImage) {
            // Calculate how much the item is visible in viewport
            const windowHeight = window.innerHeight;
            const itemCenter = rect.top + rect.height / 2;
            const distanceFromCenter = itemCenter - windowHeight / 2;

            // Only apply effect when item is in viewport
            if (rect.top < windowHeight && rect.bottom > 0) {
                // Calculate parallax offset based on scroll position
                const parallaxSpeed = 0.05; // Slower movement
                const translateX = distanceFromCenter * parallaxSpeed;

                // Apply different directions for each item
                if (index % 2 === 0) {
                    bgImage.style.transform = `translateX(${-translateX}px)`;
                } else {
                    bgImage.style.transform = `translateX(${translateX}px)`;
                }
            }
        }
    });
}

// Add to existing scroll listener
window.addEventListener('scroll', () => {
    requestAnimationFrame(updateAboutParallax);
});

// Initial check
updateAboutParallax();

// Parallax Effect for Hero - Simplified version without overlay
let ticking = false;
function updateParallax() {
    const scrolled = window.pageYOffset;
    const heroTitle = document.querySelector('.hero-title');

    if (scrolled < window.innerHeight) {
        if (heroTitle) {
            // 타이틀은 제자리에서 페이드아웃만
            heroTitle.style.opacity = Math.max(0, 1 - (scrolled / window.innerHeight) * 1.2);
        }
    }

    ticking = false;
}

function requestTick() {
    if (!ticking) {
        requestAnimationFrame(updateParallax);
        ticking = true;
    }
}

window.addEventListener('scroll', requestTick);

// Smooth Scroll for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offset = 80;
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// Video Speed Control and Error Handling
const heroVideo = document.querySelector('.hero-video');
const heroOverlay = document.querySelector('.hero-overlay');

if (heroVideo) {
    // Set video playback speed (0.5 = 50% speed, 2 = 200% speed)
    heroVideo.playbackRate = 0.7; // 70% of normal speed for smoother background

    heroVideo.addEventListener('error', () => {
        console.log('Video failed to load');
        const heroSection = document.querySelector('.hero');
        if (heroSection) {
            heroVideo.style.display = 'none';
        }
    });
}

// No animation needed - static overlay

// Remove all scroll reveal animations

// Mouse Move Gradient Effect for Hero
const hero = document.querySelector('.hero');
if (hero) {
    hero.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;

        const heroBeforeElement = hero.querySelector('::before');
        if (hero.style) {
            hero.style.setProperty('--mouse-x', `${x * 100}%`);
            hero.style.setProperty('--mouse-y', `${y * 100}%`);
        }
    });
}

// Performance Optimization - Debounce Resize
let resizeTimer;
window.addEventListener('resize', () => {
    document.body.classList.add('resize-animation-stopper');
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        document.body.classList.remove('resize-animation-stopper');
    }, 400);
});

// Add resize animation stopper CSS dynamically
const style = document.createElement('style');
style.innerHTML = `
    .resize-animation-stopper * {
        animation: none !important;
        transition: none !important;
    }
`;
document.head.appendChild(style);