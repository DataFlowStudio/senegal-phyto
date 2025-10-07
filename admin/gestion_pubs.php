<?php
session_start(); 
require('../config.php');

// Vérification si connecté
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Ajouter une pub
if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"];

    if (isset($_FILES["media"]) && $_FILES["media"]["error"] === 0) {
        $fichier = $_FILES["media"];
        $ext = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));

        $allowed = ["jpg", "jpeg", "png", "gif", "mp4", "webm", "avi"];
        if (in_array($ext, $allowed)) {
            $nomUnique = uniqid() . "." . $ext;
            $chemin = "../uploads/" . $nomUnique;

            if (move_uploaded_file($fichier["tmp_name"], $chemin)) {
                $type = in_array($ext, ["mp4", "webm", "avi"]) ? "video" : "image";

                $stmt = $conn->prepare("INSERT INTO pubs (titre, media, type) VALUES (?, ?, ?)");
                $stmt->execute([$titre, $nomUnique, $type]);

                $msg = "✅ Pub ajoutée avec succès !";
            } else {
                $msg = "❌ Erreur lors de l'upload du fichier.";
            }
        } else {
            $msg = "❌ Format non supporté (jpg, png, gif, mp4, webm, avi uniquement).";
        }
    } else {
        $msg = "❌ Aucun fichier sélectionné.";
    }
}

// Supprimer pub
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];

    // Récupérer fichier à supprimer
    $stmt = $conn->prepare("SELECT media FROM pubs WHERE id=?");
    $stmt->execute([$id]);
    $media = $stmt->fetchColumn();

    if ($media && file_exists("../uploads/" . $media)) {
        unlink("../uploads/" . $media); // Supprimer le fichier
    }

    $conn->prepare("DELETE FROM pubs WHERE id=?")->execute([$id]);
    header("Location: gestion_pubs.php");
    exit();
}

// Liste des pubs
$pubs = $conn->query("SELECT * FROM pubs ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion pubs</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>📢 Gestion des Pubs</h2>

        <?php if (!empty($msg)): ?>
            <p style="color: green; font-weight:bold;"><?= $msg ?></p>
        <?php endif; ?>

        <form method="post" class="form-add" enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Titre" required>
            <input type="file" name="media" accept="image/*,video/*" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>

        <table>
            <tr><th>ID</th><th>Titre</th><th>Média</th><th>Actions</th></tr>
            <?php foreach ($pubs as $pub): ?>
            <tr>
                <td><?= $pub["id"] ?></td>
                <td><?= htmlspecialchars($pub["titre"]) ?></td>
                <td>
                    <?php if ($pub["type"] === "image"): ?>
                        <img src="../uploads/<?= htmlspecialchars($pub["media"]) ?>" width="120">
                    <?php else: ?>
                        <video width="200" controls>
                            <source src="../uploads/<?= htmlspecialchars($pub["media"]) ?>" type="video/mp4">
                            Votre navigateur ne supporte pas la vidéo.
                        </video>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?supprimer=<?= $pub["id"] ?>" class="btn-delete" onclick="return confirm('Supprimer cette pub ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
