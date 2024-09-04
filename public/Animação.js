var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 2000,
  wrap: false
})


<script>
    document.getElementById('loadMore').addEventListener('click', function() {
        const hiddenCards = document.querySelectorAll('.hidden-cards');
        let cardsToShow = 3; // Número de cartões para mostrar a cada clique

        // Itera sobre os cartões ocultos e exibe o número necessário
        hiddenCards.forEach((card, index) => {
            if (index < cardsToShow) {
                card.style.display = 'block'; // Exibe o cartão
            }
        });

        // Verifica se todos os cartões foram exibidos
        if (document.querySelectorAll('.hidden-cards[style="display: none;"]').length === 0) {
            this.style.display = 'none'; // Esconde o botão "Ver Mais" se não houver mais cartões
        }
    });
</script>