let search = document.getElementById('pesquisa');
search.addEventListener('submit', function() {

    window.location.href = 'home.php?pesquisa=' + encodeURIComponent(search.value);
});