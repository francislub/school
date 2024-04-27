document.querySelectorAll('.login').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.img-holder').setAttribute('style', 'display:none !important;');
        document.querySelector('.form-holder').setAttribute('style', 'display:initial !important;');
    });
});
document.querySelectorAll('.instruction').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.form-holder').setAttribute('style', 'display:none !important;');
        document.querySelector('.img-holder').setAttribute('style', 'display:initial !important;');
    });
});
