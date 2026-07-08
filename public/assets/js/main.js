// Mengaktifkan animasi elemen saat elemen masuk ke area pandang pengguna.
document.addEventListener('DOMContentLoaded', () => {
    const reveals = document.querySelectorAll('.reveal');

    // IntersectionObserver lebih efisien; listener scroll dipakai sebagai fallback browser lama.
    if (window.IntersectionObserver) {
        const observer = new IntersectionObserver(
            (entries, observerInstance) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observerInstance.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.18,
                rootMargin: '0px 0px -10% 0px',
            },
        );

        reveals.forEach((item) => observer.observe(item));
    } else {
        const revealOnScroll = () => {
            reveals.forEach((item) => {
                const elementTop = item.getBoundingClientRect().top;

                if (elementTop < window.innerHeight - 90) {
                    item.classList.add('active');
                }
            });
        };

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();
    }
});
