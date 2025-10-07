<?php
session_start(); 
require('../config.php');

// Vérifier la session admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

// === AJOUTER UNE IMAGE DANS LA GALERIE ===
if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"] ?? '';

    // Vérifie si un fichier a été envoyé
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {

        $target_dir = "../uploads/galerie/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        // Vérifier le type MIME autorisé
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($_FILES["image"]["type"], $allowed)) {
            $error = "⚠️ Format non supporté. Formats acceptés : JPG, PNG, GIF, WEBP.";
        } else {
            // Upload du fichier
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insertion dans la base
                $stmt = $conn->prepare("INSERT INTO galerie (titre, image) VALUES (?, ?)");
                $stmt->execute([$titre, "uploads/galerie/" . $file_name]);
                $success = "✅ Image ajoutée avec succès.";
            } else {
                $error = "❌ Erreur lors de l'upload de l'image.";
            }
        }
    } else {
        $error = "Veuillez sélectionner une image à télécharger.";
    }
}

// === SUPPRESSION D’UNE IMAGE ===
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $stmt = $conn->prepare("SELECT image FROM galerie WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();

    if ($image && file_exists("../" . $image)) {
        unlink("../" . $image);
    }

    $conn->prepare("DELETE FROM galerie WHERE id=?")->execute([$id]);
    $success = "🗑️ Image supprimée avec succès.";
}

// === LISTER LES IMAGES ===
$galerie = $conn->query("SELECT * FROM galerie ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Galerie - Sénégal Phyto</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="container">
    <?php include "includes/sidebar.php"; ?>

    <main>
        <h2>🖼️ Gestion de la galerie</h2>

        <?php if (!empty($error)): ?>
            <p style="color:#cc0000; font-weight:bold;"><?= $error ?></p>
        <?php elseif (!empty($success)): ?>
            <p style="color:#006400; font-weight:bold;"><?= $success ?></p>
        <?php endif; ?>

        <form method="post" class="form-add" enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Titre (facultatif)">
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>

        <table>
            <tr><th>ID</th><th>Titre</th><th>Image</th><th>Actions</th></tr>
            <?php foreach ($galerie as $g): ?>
            <tr>
                <td><?= $g["id"] ?></td>
                <td><?= htmlspecialchars($g["titre"]) ?></td>
                <td><img src="../<?= htmlspecialchars($g["image"]) ?>" width="100" style="border-radius:6px;"></td>
                <td>
                    <a href="?supprimer=<?= $g["id"] ?>" class="btn-delete" onclick="return confirm('Supprimer cette image ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
