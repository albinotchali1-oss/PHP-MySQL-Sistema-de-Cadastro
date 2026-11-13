document.querySelectorAll('[data-toggle-password]').forEach((button) => {
    const input = document.getElementById(button.getAttribute('aria-controls'));

    if (!(input instanceof HTMLInputElement)) {
        return;
    }

    button.addEventListener('click', () => {
        const mostrar = input.type === 'password';
        input.type = mostrar ? 'text' : 'password';
        button.textContent = mostrar ? 'Ocultar' : 'Mostrar';
        button.setAttribute('aria-pressed', String(mostrar));
        button.setAttribute('aria-label', `${mostrar ? 'Ocultar' : 'Mostrar'} senha`);
    });
});