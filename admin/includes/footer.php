<footer class="main-footer">
    <div class="footer-left">
        <i class="fa-solid fa-leaf footer-icon"></i>
        <span class="footer-title">Sénégal Phyto - Admin</span>
    </div>

    <div class="footer-right">
        <p>&copy; <?= date("Y"); ?> Tous droits réservés | Tableau de bord administrateur 💻</p>
    </div>
</footer>

<style>
/* === FOOTER === */
.main-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(90deg, #006400, #2E8B57);
    color: #fff;
    padding: 14px 25px;
    box-shadow: 0 -3px 8px rgba(0,0,0,0.15);
    position: relative;
    font-size: 14px;
}

.footer-left {
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-icon {
    font-size: 20px;
    color: #f1c40f;
}

.footer-title {
    font-weight: 600;
    font-size: 15px;
    letter-spacing: 0.3px;
}

.footer-right p {
    margin: 0;
}

/* === Responsive === */
@media (max-width: 700px) {
    .main-footer {
        flex-direction: column;
        text-align: center;
        gap: 6px;
    }
}
</style>
