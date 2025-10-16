<?php
session_start();
require('../config.php');

// Vérifier la session admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

// === AJOUTER UNE IMAGE ===
if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"] ?? '';

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $target_dir = "../uploads/galerie/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($_FILES["image"]["type"], $allowed)) {
            $error = "⚠️ Format non supporté. Formats acceptés : JPG, PNG, GIF, WEBP.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO galerie (titre, image) VALUES (?, ?)");
                $stmt->execute([$titre, "uploads/galerie/" . $file_name]);
                header("Location: gestion_galerie.php?added=1");
                exit;
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
    header("Location: gestion_galerie.php?deleted=1");
    exit;
}

// === LISTER LES IMAGES ===
$galerie = $conn->query("SELECT * FROM galerie ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion de la Galerie</title>
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
    .form-add {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }
    .form-add input[type="text"],
    .form-add input[type="file"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    .form-add button {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .form-add button:hover {
        background: #45a049;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    img {
        border-radius: 6px;
    }
    .btn-delete {
        background: none;
        border: none;
        cursor: pointer;
        color: #e74c3c;
        font-size: 18px;
        padding: 6px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }
    .btn-delete:hover {
        background: #fdecea;
    }
</style>
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="container">
    <?php include "includes/sidebar.php"; ?>

    <main>
        <h2><i class="fa-solid fa-image"></i> Gestion de la Galerie</h2>

        <?php if (!empty($error)): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "<?= addslashes($error) ?>",
                    confirmButtonText: 'OK'
                });
            </script>
        <?php elseif (isset($_GET['added'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Image ajoutée avec succès ✅',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php elseif (isset($_GET['deleted'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Image supprimée avec succès 🗑️',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <form method="post" class="form-add" enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Titre de l'image">
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="ajouter"><i class="fa-solid fa-plus"></i> Ajouter</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php if (count($galerie) > 0): ?>
                <?php foreach ($galerie as $g): ?>
                <tr>
                    <td><?= $g["id"] ?></td>
                    <td><?= htmlspecialchars($g["titre"]) ?></td>
                    <td><img src="../<?= htmlspecialchars($g["image"]) ?>" width="100"></td>
                    <td>
                        <button class="btn-delete" onclick="confirmerSuppression(<?= $g['id'] ?>)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="color:#888;">Aucune image trouvée dans la galerie.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

<?php include "includes/footer.php"; ?>

<script>
// Confirmation avant suppression
function confirmerSuppression(id) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette image sera supprimée définitivement.",
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
