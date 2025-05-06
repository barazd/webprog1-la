function lightbox(title, src) {
    const lightbox = document.getElementById('lightbox');

    lightbox.querySelector('.box').innerHTML = `<img src="${src}" /><p>${title}</p>`;

    lightbox.classList.remove('hidden');
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');

    lightbox.querySelector('.box').innerHTML = '';

    lightbox.classList.add('hidden');
}