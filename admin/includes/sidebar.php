<aside class="main-sidebar">
    <div class="sidebar-header">
        <i class="fa-solid fa-leaf sidebar-logo"></i>
        <span class="sidebar-title">Sénégal Phyto</span>
    </div>
 
    <ul class="sidebar-menu">
        <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>"><i class="fa-solid fa-chart-line"></i> Tableau de bord</a></li>
        <li><a href="gestion_pubs.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gestion_pubs.php' ? 'active' : '' ?>"><i class="fa-solid fa-bullhorn"></i> Gestion des Pubs</a></li>
        <li><a href="gestion_temoignages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gestion_temoignages.php' ? 'active' : '' ?>"><i class="fa-solid fa-comments"></i> Témoignages</a></li>
        <li><a href="gestion_galerie.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gestion_galerie.php' ? 'active' : '' ?>"><i class="fa-solid fa-image"></i> Galerie</a></li>
        <li><a href="messages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : '' ?>"><i class="fa-solid fa-envelope"></i> Messages</a></li>
    </ul>
</aside>

<style>
/* === SIDEBAR === */
.main-sidebar {
    width: 240px;
    min-height: 100vh;
    background: linear-gradient(180deg, #006400, #2E8B57);
    color: #fff;
    display: flex;
    flex-direction: column;
    padding-top: 10px;
    box-shadow: 2px 0 8px rgba(0,0,0,0.2);
    flex-shrink: 0;
}

.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 15px 10px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar-logo {
    font-size: 22px;
    color: #f1c40f;
}

.sidebar-title {
    font-weight: 700;
    font-size: 18px;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin-top: 20px;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    padding: 12px 20px;
    transition: 0.25s;
}

.sidebar-menu a i {
    font-size: 17px;
}

.sidebar-menu a:hover {
    background: rgba(241,196,15,0.2);
    border-left: 4px solid #f1c40f;
    padding-left: 16px;
}

.sidebar-menu a.active {
    background: rgba(241,196,15,0.25);
    color: #f1c40f;
    border-left: 4px solid #f1c40f;
    font-weight: 600;
}
</style>