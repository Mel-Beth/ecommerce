<header class="bg-yellow-500 text-white p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold"><i class="fas fa-store"></i> Mon E-commerce</h1>
        <nav>
            <a href="index.php" class="px-4 hover:underline"><i class="fas fa-home"></i> Accueil</a>
            <a href="index.php?controller=panier&action=index" class="px-4 hover:underline"><i class="fas fa-shopping-cart"></i> Panier</a>
            <?php if (isAuthenticated()): ?>
                <a href="logout.php" class="px-4 hover:underline"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="px-4 hover:underline"><i class="fas fa-user"></i> Connexion</a>
            <?php endif; ?>
        </nav>
        <button id="theme-toggle" class="bg-gray-800 text-white px-2 py-1 rounded">
            <i class="fas fa-adjust"></i> Mode sombre
        </button>
    </div>
</header>
