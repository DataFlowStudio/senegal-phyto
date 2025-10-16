<?php
session_start();
require('../config.php');

// Vérification de session
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

$msg = "";
$alertType = "";

// ➕ Ajouter une pub
if (isset($_POST["ajouter"])) {
    $titre = trim($_POST["titre"]);

    if (!empty($titre) && isset($_FILES["media"]) && $_FILES["media"]["error"] === 0) {
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

                $_SESSION["alert"] = ["type" => "success", "msg" => "✅ Pub ajoutée avec succès !"];
                header("Location: gestion_pubs.php");
                exit();
            } else {
                $alertType = "error";
                $msg = "Erreur lors de l'upload du fichier.";
            }
        } else {
            $alertType = "error";
            $msg = "Format non supporté. Formats autorisés : jpg, png, gif, mp4, webm, avi.";
        }
    } else {
        $alertType = "error";
        $msg = "Veuillez remplir tous les champs et sélectionner un fichier.";
    }
}

// 🗑️ Supprimer une pub
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];

    // Récupérer le fichier avant suppression
    $stmt = $conn->prepare("SELECT media FROM pubs WHERE id=?");
    $stmt->execute([$id]);
    $media = $stmt->fetchColumn();

    if ($media && file_exists("../uploads/" . $media)) {
        unlink("../uploads/" . $media);
    }

    $conn->prepare("DELETE FROM pubs WHERE id=?")->execute([$id]);

    $_SESSION["alert"] = ["type" => "success", "msg" => "🗑️ Pub supprimée avec succès !"];
    header("Location: gestion_pubs.php");
    exit();
}

// 📋 Liste des pubs
$pubs = $conn->query("SELECT * FROM pubs ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des Pubs</title>
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
    .form-add {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .form-add input, .form-add button {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
    .form-add button {
        background-color: #27ae60;
        color: white;
        cursor: pointer;
        border: none;
        font-weight: bold;
    }
    .form-add button:hover {
        background-color: #219150;
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
    img, video {
        border-radius: 10px;
    }
    .btn-delete {
        background: #e74c3c;
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }
    .btn-delete:hover {
        background: #c0392b;
    }
</style>
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2><i class="fa-solid fa-bullhorn"></i> Gestion des Pubs</h2>

        <form method="post" class="form-add" enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Titre de la pub" required>
            <input type="file" name="media" accept="image/*,video/*" required>
            <button type="submit" name="ajouter">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>
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
                        </video>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?supprimer=<?= $pub["id"] ?>" class="btn-delete btn-supp" data-id="<?= $pub["id"] ?>">
                        <i class="fa-solid fa-trash"></i> Supprimer
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>

<script>
// ✅ Popup SweetAlert après action
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
            text: "Cette action est irréversible.",
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
