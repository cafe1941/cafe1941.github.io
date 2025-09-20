// Smooth cubic-bezier animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

// Remove map animation - show everything immediately

// Remove parallax effect for about items

// Remove all parallax effects

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

// Overlay fade with CSS animation
if (heroOverlay) {
    // Use CSS animation instead of JavaScript for better performance
    heroOverlay.style.animation = 'fadeOverlay 1s ease-out forwards';

    // Add CSS animation
    if (!document.querySelector('#overlay-animation')) {
        const style = document.createElement('style');
        style.id = 'overlay-animation';
        style.innerHTML = `
            @keyframes fadeOverlay {
                from { opacity: 1; }
                to { opacity: 0.3; }
            }
        `;
        document.head.appendChild(style);
    }
}

if (heroVideo) {
    // Set video playback speed
    heroVideo.playbackRate = 0.7;

    // Optimize video playback
    let videoPlayTimer;
    const forceVideoPlay = () => {
        clearTimeout(videoPlayTimer);
        videoPlayTimer = setTimeout(() => {
            if (heroVideo.paused) {
                heroVideo.play().catch(e => console.log('Video play interrupted:', e));
            }
        }, 100);
    };

    // iOS specific fixes with throttling
    document.addEventListener('touchstart', forceVideoPlay, { passive: true });
    document.addEventListener('scroll', forceVideoPlay, { passive: true });

    // Ensure video stays playing
    heroVideo.addEventListener('pause', () => {
        forceVideoPlay();
    });

    heroVideo.addEventListener('error', () => {
        console.log('Video failed to load');
        const heroSection = document.querySelector('.hero');
        if (heroSection) {
            heroVideo.style.display = 'none';
        }
    });
}

// No animation needed - static overlay

// Scroll reveal animation for about content - Optimized
const observeAboutContent = () => {
    const aboutContents = document.querySelectorAll('.about-content');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Use setTimeout to defer non-critical animations
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, 0);
                // Stop observing after animation trigger
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    });

    aboutContents.forEach(content => {
        observer.observe(content);
    });
};

// Lazy loading for background images
const lazyLoadBackgrounds = () => {
    const lazyBackgrounds = document.querySelectorAll('.about-bg-image');

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bgElement = entry.target;
                const parent = bgElement.parentElement;
                const imageType = parent.dataset.image;

                // Load the background image
                if (imageType) {
                    bgElement.style.backgroundImage = `url('assets/optimized_${imageType}.jpg')`;
                }

                // Stop observing this element
                observer.unobserve(bgElement);
            }
        });
    }, {
        rootMargin: '100px 0px',
        threshold: 0.01
    });

    lazyBackgrounds.forEach(bg => {
        imageObserver.observe(bg);
    });
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        observeAboutContent();
        lazyLoadBackgrounds();
    });
} else {
    observeAboutContent();
    lazyLoadBackgrounds();
}

// Mouse Move Gradient Effect for Hero - Throttled
const hero = document.querySelector('.hero');
if (hero) {
    let isThrottled = false;
    hero.addEventListener('mousemove', (e) => {
        if (isThrottled) return;

        isThrottled = true;
        requestAnimationFrame(() => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            if (hero.style) {
                hero.style.setProperty('--mouse-x', `${x * 100}%`);
                hero.style.setProperty('--mouse-y', `${y * 100}%`);
            }
            isThrottled = false;
        });
    }, { passive: true });
}

// Performance Optimization - Debounce Resize
let resizeTimer;
window.addEventListener('resize', () => {
    document.body.classList.add('resize-animation-stopper');
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        document.body.classList.remove('resize-animation-stopper');
    }, 400);
}, { passive: true });

// Add resize animation stopper CSS dynamically
const style = document.createElement('style');
style.innerHTML = `
    .resize-animation-stopper * {
        animation: none !important;
        transition: none !important;
    }
`;
document.head.appendChild(style);