<?php require_once 'C:\laragon\www\alhidaya-connect\config\config.php'; ?>
<link rel="stylesheet" href="../../../public_html/css/style.css">

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/resources/views/events/index.php">Events</a>
        </nav>
        <div class="logres">
            <?php if(isset($_SESSION['user_id'])): ?>
                <p>Welkom <strong><?php echo $_SESSION['user_name']; ?></strong> | <a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a></p>
            <?php else: ?>
                <p><a href="<?php echo $base_url; ?>/login.php">Inloggen</a></p>
            <?php endif; ?>
        </div>
    </div>
</header>
