<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
    <a class="navbar-brand fw-bold" href="/HYBECORP/index.php"><?= SITE_NAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link <?= ($pageTitle == 'Home') ? 'active' : '' ?>" href="/HYBECORP/index.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?= ($pageTitle == 'Merchandise') ? 'active' : '' ?>" href="/HYBECORP/merchandise.php">Merchandise</a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?= ($pageTitle == 'Contact') ? 'active' : '' ?>" href="/HYBECORP/contact.php">Contact</a>
        </li>
    </ul>
    </div>
    </div>
</nav>
