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

// Overlay fade animation using JavaScript
if (heroOverlay) {
    let overlayAnimationComplete = false;
    let startTime = null;
    const duration = 1000; // 1 second

    function animateOverlay(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);

        // Animate from opacity 1 to 0.3
        const opacity = 1 - (progress * 0.7);
        heroOverlay.style.opacity = opacity;

        if (progress < 1) {
            requestAnimationFrame(animateOverlay);
        } else {
            overlayAnimationComplete = true;
        }
    }

    // Start animation on page load
    requestAnimationFrame(animateOverlay);

    // Prevent animation reset on iOS
    let scrollTimeout;
    document.addEventListener('touchmove', (e) => {
        if (!overlayAnimationComplete) {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                // Continue animation after touch ends
            }, 100);
        }
    }, { passive: true });
}

if (heroVideo) {
    // Set video playback speed
    heroVideo.playbackRate = 0.7;

    // Force video to keep playing on iOS
    const forceVideoPlay = () => {
        if (heroVideo.paused) {
            heroVideo.play().catch(e => console.log('Video play interrupted:', e));
        }
    };

    // iOS specific fixes
    document.addEventListener('touchstart', forceVideoPlay, { passive: true });
    document.addEventListener('touchmove', forceVideoPlay, { passive: true });
    document.addEventListener('scroll', forceVideoPlay, { passive: true });

    // Ensure video stays playing
    heroVideo.addEventListener('pause', () => {
        heroVideo.play().catch(e => console.log('Video play interrupted:', e));
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

// Scroll reveal animation for about content
const observeAboutContent = () => {
    const aboutContents = document.querySelectorAll('.about-content');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
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

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', observeAboutContent);
} else {
    observeAboutContent();
}

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

// Popup Modal Logic (temporarily disabled)
/*
const initPopup = () => {
    const popup = document.getElementById('welcomePopup');
    const popupCloseBtn = document.querySelector('.popup-close');
    const popupConfirmBtn = document.querySelector('.popup-btn');

    if (!popup) return;

    // Close popup function
    const closePopup = () => {
        popup.classList.remove('active');
    };

    // Show popup after a short delay
    setTimeout(() => {
        popup.classList.add('active');
    }, 500);

    // Close popup when close button is clicked
    if (popupCloseBtn) {
        popupCloseBtn.addEventListener('click', closePopup);
    }

    // Close popup when confirm button is clicked
    if (popupConfirmBtn) {
        popupConfirmBtn.addEventListener('click', closePopup);
    }

    // Close popup when clicking outside the popup content
    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            closePopup();
        }
    });

    // Close popup with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popup.classList.contains('active')) {
            closePopup();
        }
    });
};

// Initialize popup when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPopup);
} else {
    initPopup();
}
*/