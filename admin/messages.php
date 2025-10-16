<?php
session_start();
require('../config.php');

// Vérification de session
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// 📨 Marquer comme lu
if (isset($_GET["lu"])) {
    $id = $_GET["lu"];
    $conn->prepare("UPDATE messages SET statut='lu' WHERE id=?")->execute([$id]);
    $_SESSION["alert"] = ["type" => "success", "msg" => "📬 Message marqué comme lu !"];
    header("Location: messages.php");
    exit();
}

// 🗑️ Supprimer un message
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM messages WHERE id=?")->execute([$id]);
    $_SESSION["alert"] = ["type" => "success", "msg" => "🗑️ Message supprimé avec succès !"];
    header("Location: messages.php");
    exit();
}

// 📋 Récupération des messages
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Messages reçus</title>
<link rel="stylesheet" href="style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    main {
        padding: 20px;
    }
    h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #2c3e50;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    th {
        background: #2ecc71;
        color: white;
        text-transform: uppercase;
    }
    th, td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .status {
        font-weight: bold;
    }
    .status.lu {
        color: #27ae60;
    }
    .status.non_lu {
        color: #e67e22;
    }
    .action-icons a {
        margin: 0 6px;
        text-decoration: none;
        font-size: 16px;
        padding: 6px 10px;
        border-radius: 6px;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .mark-read {
        background: #3498db;
        color: white;
    }
    .mark-read:hover {
        background: #2d83c1;
    }
    .delete {
        background: #e74c3c;
        color: white;
    }
    .delete:hover {
        background: #c0392b;
    }
</style>
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2><i class="fa-solid fa-envelope"></i> Messages reçus</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= $m["id"] ?></td>
                <td><?= htmlspecialchars($m["nom"]) ?></td>
                <td><?= htmlspecialchars($m["email"]) ?></td>
                <td><?= htmlspecialchars($m["telephone"]) ?></td>
                <td><?= htmlspecialchars($m["sujet"]) ?></td>
                <td style="text-align:left;"><?= nl2br(htmlspecialchars($m["message"])) ?></td>
                <td class="status <?= $m["statut"] ?>">
                    <?= $m["statut"] === "non_lu" ? "📩 Non lu" : "✅ Lu" ?>
                </td>
                <td class="action-icons">
                    <?php if ($m["statut"] === "non_lu"): ?>
                        <a href="?lu=<?= $m["id"] ?>" class="mark-read" title="Marquer comme lu">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </a>
                    <?php endif; ?>
                    <a href="?supprimer=<?= $m["id"] ?>" class="delete btn-supp" data-id="<?= $m["id"] ?>" title="Supprimer">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>

<!-- ✅ Gestion des alertes SweetAlert -->
<script>
<?php if (!empty($_SESSION["alert"])): ?>
Swal.fire({
    icon: '<?= $_SESSION["alert"]["type"] ?>',
    title: '<?= addslashes($_SESSION["alert"]["msg"]) ?>',
    showConfirmButton: false,
    timer: 2000
});
<?php unset($_SESSION["alert"]); endif; ?>

// ⚠️ Confirmation avant suppression
document.querySelectorAll(".btn-supp").forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        const url = this.getAttribute("href");

        Swal.fire({
            title: "Êtes-vous sûr ?",
            text: "Ce message sera définitivement supprimé.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e74c3c",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Oui, supprimer",
            cancelButtonText: "Annuler"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

<?php include "includes/footer.php"; ?>
</body>
</html>
