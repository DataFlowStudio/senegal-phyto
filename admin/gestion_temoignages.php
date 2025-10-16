<?php
session_start();
require('../config.php');

// Vérifier la session admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

// Approuver un témoignage
if (isset($_GET["approuver"])) {
    $id = $_GET["approuver"];
    $stmt = $conn->prepare("UPDATE temoignages SET statut='approuve' WHERE id=?");
    $stmt->execute([$id]);
    header("Location: gestion_temoignages.php?approved=1");
    exit;
}

// Supprimer un témoignage
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $stmt = $conn->prepare("DELETE FROM temoignages WHERE id=?");
    $stmt->execute([$id]);
    header("Location: gestion_temoignages.php?deleted=1");
    exit;
}

// Récupérer la liste des témoignages
$temoignages = $conn->query("SELECT * FROM temoignages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des Témoignages</title>
<link rel="stylesheet" href="style.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    main {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: 20px;
    }
    h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .action-icons a {
        margin: 0 6px;
        text-decoration: none;
        font-size: 18px;
        padding: 6px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }
    .approve {
        color: #28a745;
    }
    .approve:hover {
        background: #e7fbe7;
    }
    .delete {
        color: #e74c3c;
    }
    .delete:hover {
        background: #fdecea;
    }
</style>
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2><i class="fa-solid fa-comments"></i> Gestion des Témoignages</h2>

        <?php if (isset($_GET['approved'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Témoignage approuvé avec succès ✅',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php elseif (isset($_GET['deleted'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Témoignage supprimé avec succès 🗑️',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            <?php if (count($temoignages) > 0): ?>
                <?php foreach ($temoignages as $t): ?>
                <tr>
                    <td><?= $t["id"] ?></td>
                    <td><?= htmlspecialchars($t["nom"]) ?></td>
                    <td><?= nl2br(htmlspecialchars($t["message"])) ?></td>
                    <td>
                        <?php if ($t["statut"] === "en_attente"): ?>
                            <span style="color:#f39c12;"><i class="fa-solid fa-hourglass-half"></i> En attente</span>
                        <?php else: ?>
                            <span style="color:#28a745;"><i class="fa-solid fa-check-circle"></i> Approuvé</span>
                        <?php endif; ?>
                    </td>
                    <td class="action-icons">
                        <?php if ($t["statut"] === "en_attente"): ?>
                            <a href="?approuver=<?= $t["id"] ?>" class="approve" title="Approuver">
                                <i class="fa-solid fa-check-circle"></i>
                            </a>
                        <?php endif; ?>
                        <a href="#" class="delete" title="Supprimer" onclick="confirmerSuppression(<?= $t['id'] ?>)">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:#888;">Aucun témoignage trouvé.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

<?php include "includes/footer.php"; ?>

<script>
// Popup de confirmation avant suppression
function confirmerSuppression(id) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action supprimera définitivement le témoignage.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '?supprimer=' + id;
        }
    });
}
</script>
</body>
</html>
