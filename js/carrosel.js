const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const prevBtnProdutos = document.getElementById('prevBtnProdutos');
const nextBtnProdutos = document.getElementById('nextBtnProdutos');
const carrossel = document.getElementById('carrossel');
const carrosselProdutos = document.getElementById('carrosselProdutos');
let scrollAmount = 0;
const scrollDistance = 320; // Distância de rolagem por clique
const scrollDuration = 200; // Duração da rolagem em milissegundos

let isScrolling = false;

function scrollCarrossel(carrosselElement, distance) {
    if (isScrolling) return;
    isScrolling = true;

    // Verifica se o movimento vai além do limite esquerdo ou direito do carrossel
    const maxScroll = carrosselElement.scrollWidth - carrosselElement.clientWidth;
    scrollAmount = Math.max(0, Math.min(maxScroll, scrollAmount + distance));

    carrosselElement.scrollTo({
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
    scrollCarrossel(carrossel, scrollDistance);
});

prevBtn.addEventListener('click', () => {
    scrollCarrossel(carrossel, -scrollDistance);
});

nextBtnProdutos.addEventListener('click', () => {
    scrollCarrossel(carrosselProdutos, scrollDistance);
});

prevBtnProdutos.addEventListener('click', () => {
    scrollCarrossel(carrosselProdutos, -scrollDistance);
});
