<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!empty($_SESSION['last_message']) && is_array($_SESSION['last_message'])) {
    echo json_encode($_SESSION['last_message']);
} else {
    echo json_encode(new stdClass()); // renvoie {} si rien
}
