<?php require_once __DIR__.'/../backend/config.php'; ?>

<header>
    <div class="navbar">
        <div class="navdiv">
            <img class="logohome" src="<?php echo $base_url; ?>/img/logo-big-outlines-only.png" alt="logo1">
            <ul>
                <li><a href="<?php echo $base_url; ?>/index.php">Home</a></li>
                <li><a href="<?php echo $base_url; ?>/afdelingen.html">Overzicht Afdelingen</a></li>
                <li><a href="<?php echo $base_url; ?>/taken/index.php"> Taken</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button><a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a></button>
                <?php else: ?>
                    <button><a href="<?php echo $base_url; ?>/login.php">Log in</a></button>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
