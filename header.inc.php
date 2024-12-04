<!-- Navigatiebalk -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Producten</a></li>
            <li><a href="about.php">Over Ons</a></li>
            <li><a href="contact.php">Contact</a></li>
            
            <!-- Alleen zichtbaar voor ingelogde gebruikers -->
            <?php if (isset($_SESSION["username"])): ?>
                <li><a href="cart.php">Winkelmandje</a></li>
                <li><a href="profile.php">Mijn profiel</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            <?php else: ?>
                <li><a href="login.php">Inloggen</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
