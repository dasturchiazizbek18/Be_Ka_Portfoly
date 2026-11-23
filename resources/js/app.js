import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // 1. Live camera timecode ticker in Hero Viewfinder
    const tcEl = document.getElementById('live-timecode');
    if (tcEl) {
        let frames = 14 * 24;
        const pad = (n) => String(n).padStart(2, '0');
        setInterval(() => {
            frames = (frames + 1) % (24 * 3600);
            const f = frames % 24;
            const totalSeconds = Math.floor(frames / 24);
            const s = totalSeconds % 60;
            const m = Math.floor(totalSeconds / 60) % 60;
            const h = Math.floor(totalSeconds / 3600);
            tcEl.textContent = `${pad(h)}:${pad(m)}:${pad(s)}:${pad(f)}`;
        }, 42);
    }

    // 2. Progressive fallback for <dialog closedby="any">
    if (!('closedBy' in HTMLDialogElement.prototype)) {
        const outside = (e, dialog) => {
            const r = dialog.getBoundingClientRect();
            return e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r.bottom;
        };
        for (const dialog of document.querySelectorAll('dialog[closedby="any"]')) {
            let pressedOutside = false;
            dialog.addEventListener('pointerdown', (e) => {
                pressedOutside = outside(e, dialog);
            });
            dialog.addEventListener('pointerup', (e) => {
                if (pressedOutside && outside(e, dialog)) {
                    dialog.close();
                }
            });
        }
    }

    // 3. Scroll reveal observer (instant visible in scaled mobile mode to prevent zoom IO quirks)
    const revealEls = document.querySelectorAll('.reveal-item');
    if (window.innerWidth >= 1180 && 'IntersectionObserver' in window && revealEls.length) {
        const io = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        io.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -30px 0px' }
        );
        revealEls.forEach((el) => io.observe(el));
    } else {
        revealEls.forEach((el) => el.classList.add('is-visible'));
    }
});
