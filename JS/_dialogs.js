const dialog = document.querySelector('#dialog-airport');
const departurePopup = document.querySelector('#departure-btn');
const arrivalPopup = document.querySelector('#arrival-btn');
const closePopup = document.querySelector('.dialog__close');

departurePopup.addEventListener('click', e => {
    dialog.querySelector('#dialog-airport-title').innerText = "출발지 검색"
    dialog.style.display = "flex"
})

arrivalPopup.addEventListener('click', e => {
    dialog.querySelector('#dialog-airport-title').innerText = "도착지 검색"
    dialog.style.display = "flex"
})

closePopup.addEventListener('click', e => {
    dialog.style.display = "none"
})