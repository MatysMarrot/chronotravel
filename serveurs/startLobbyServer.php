<?php
include_once(__DIR__ . "/lobby.srvr.php");

try{
    ServerImpl::get()->run();
}catch(Exception){
    $webhookUrl = 'https://discord.com/api/webhooks/1201506317769125918/PrWHpzPYpdYxBWz-pdDHXjgONXorQn7Y-eg8Pk3d9dW-dDqdTo6LjZQ8DlheQ1kaF0wo';

    // Message à envoyer
    $message = '@yanissou : Lobby Server went DOWN !';

    // Créer une structure de données pour le message
    $data = [
        'content' => $message,
    ];

    // Convertir les données en format JSON
    $json_data = json_encode($data);

    // Configuration de la requête HTTP
    $options = [
        'http' => [
            'header'  => 'Content-type: application/json',
            'method'  => 'POST',
            'content' => $json_data,
        ],
    ];

    // Création du contexte de la requête
    $context  = stream_context_create($options);

    // Envoi de la requête HTTP au webhook
    $result = file_get_contents($webhookUrl, false, $context);
}

?>
