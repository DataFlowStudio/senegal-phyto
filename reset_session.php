<?php
session_start();
// supprime uniquement la donnée temporaire
unset($_SESSION['last_message']);
// renvoyer un statut OK optionnel
http_response_code(200);
echo 'ok';
