const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const carrossel = document.getElementById('carrossel');

nextBtn.addEventListener('click', () => {
    carrossel.scrollBy({
        top: 0,
        left: 320,
        behavior: 'smooth'
    });
});

prevBtn.addEventListener('click', () => {
    carrossel.scrollBy({
        top: 0,
        left: -320,
        behavior: 'smooth'
    });
});
