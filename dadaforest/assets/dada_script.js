document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const projectCards = document.querySelectorAll('.project-card');
    // Modal elements were detected but not present in current HTML. Keeping declarations safe if used later, 
    // but noting that projectModal is strictly in index.html if at all.
    // If modal HTML was removed (it seems so in index.html rewrite), these might error.
    // However, user only asked to remove filtering. I will remove filtering logic.
    const modal = document.getElementById('projectModal');
    const modalImg = modal.querySelector('.modal-img');
    const modalTitle = modal.querySelector('.modal-title');
    const modalDesc = modal.querySelector('.modal-desc');
    const modalClose = modal.querySelector('.modal-close');

    // Header scroll effect
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });


    // Modal logic
    projectCards.forEach(card => {
        card.addEventListener('click', () => {
            const img = card.dataset.img;
            const title = card.querySelector('h3').textContent;
            const desc = card.dataset.desc || card.querySelector('p').textContent;

            modalImg.src = img;
            modalTitle.textContent = title;
            modalDesc.textContent = desc;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    modalClose.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });

    // Intersection Observer for scroll animations
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });
});
