<header class="main-header">
    <div class="logo-section">
        <i class="fa-solid fa-leaf logo-icon"></i>
        <h1 class="logo-title">Sénégal Phyto - Admin</h1>
    </div>

    <div class="user-section">
        <span class="admin-name">
            <i class="fa-solid fa-user-shield"></i>
            Admin
        </span>
        <a href="logout.php" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Déconnexion
        </a>
    </div>
</header>

<style>
/* === HEADER === */
.main-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(90deg, #006400, #2E8B57);
    color: #fff;
    padding: 14px 25px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-icon {
    font-size: 26px;
    color: #f1c40f;
}

.logo-title {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.user-section {
    display: flex;
    align-items: center;
    gap: 18px;
}

.admin-name {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 15px;
}

.btn-logout {
    background: #f1c40f;
    color: #006400;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.25s;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-logout:hover {
    background: #fff;
    color: #006400;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
</style>
