<script>
    let DisplayTanksButton = document.querySelector('.DisplayTanksButton');
    let Tanks = document.querySelector('.Tanks');
    let CloseTanksButton = document.querySelector('.close-button-tanks');
    DisplayTanksButton.addEventListener('click', () => {
        Tanks.style.display = 'flex';
    });
    CloseTanksButton.addEventListener('click', () => {
        Tanks.style.display = 'none';
    });
</script>