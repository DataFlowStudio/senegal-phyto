<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['clientName']);
    $message = trim($_POST['testimonialMessage']);

    if ($nom && $message) {
        $stmt = $conn->prepare("INSERT INTO temoignages (nom, message, statut) VALUES (?, ?, 'en_attente')");
        $stmt->execute([$nom, $message]);

        echo json_encode([
            'success' => true,
            'message' => '✅ Merci pour votre témoignage ! Il sera publié après validation.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Veuillez remplir tous les champs obligatoires.'
        ]);
    }
}
?>
