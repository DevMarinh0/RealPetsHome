const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const carrossel = document.getElementById('carrossel');
let scrollAmount = 0;
const scrollDistance = 320; // Distância de rolagem por clique
const scrollDuration = 200; // Duração da rolagem em milissegundos

let isScrolling = false;

function scrollCarrossel(distance) {
    if (isScrolling) return;
    isScrolling = true;

    // Verifica se o movimento vai além do limite esquerdo ou direito do carrossel
    const maxScroll = carrossel.scrollWidth - carrossel.clientWidth;
    scrollAmount = Math.max(0, Math.min(maxScroll, scrollAmount + distance));

    carrossel.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: 'smooth'
    });

    // Reativa os botões após a rolagem estar concluída
    setTimeout(() => {
        isScrolling = false;
    }, scrollDuration);
}

nextBtn.addEventListener('click', () => {
    scrollCarrossel(scrollDistance);
});

prevBtn.addEventListener('click', () => {
    scrollCarrossel(-scrollDistance);
});
