document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
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

    // Filtering logic
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            // Update buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Update gallery
            projectCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.classList.remove('hide');
                    setTimeout(() => card.style.opacity = '1', 10);
                } else {
                    card.classList.add('hide');
                    card.style.opacity = '0';
                }
            });
        });
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
