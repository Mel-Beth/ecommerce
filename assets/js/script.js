// Script pour basculer entre le mode clair et sombre
document.getElementById('theme-toggle').addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');
});

// Basculer le mode sombre
document.getElementById('theme-toggle').addEventListener('click', function () {
    document.body.classList.toggle('dark');
    localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
});

// Charger le mode sombre par défaut si activé
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark');
}
