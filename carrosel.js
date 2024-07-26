const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const carrossel = document.getElementById('carrossel');
let scrollAmount = 0;

nextBtn.addEventListener('click', () => {
    carrossel.scrollTo({
        top: 0,
        left: (scrollAmount += 320),
        behavior: 'smooth'
    });
});

prevBtn.addEventListener('click', () => {
    carrossel.scrollTo({
        top: 0,
        left: (scrollAmount -= 320),
        behavior: 'smooth'
    });
});
