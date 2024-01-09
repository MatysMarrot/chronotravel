const text = document.querySelector('.countdown');

const now = new Date().getTime();
let countdownDate = new Date((now + 1 * 60000)+5000);

function getChrono() {
    const distanceBase = countdownDate - now;

    const minutes = Math.floor((distanceBase % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distanceBase % (1000 * 60)) / 1000);

    text.innerText = `${minutes}m ${seconds}s`;

    if (distanceBase < 60000) {
        text.style.color = 'red';
    }

    if (countdownDate.getTime() <= now) {
        clearInterval(countDownInterval); // Arrêter l'intervalle lorsque countdownDate atteint 0
        text.innerText = "Temps écoulé"; // Vous pouvez mettre un message différent si nécessaire
    }

}

getChrono();

if (countdownDate.getTime() !== now) {
    const countDownInterval = setInterval(() => {
        getChrono();
        countdownDate = new Date(countdownDate.getTime() - 1000);
    }, 1000);
}
