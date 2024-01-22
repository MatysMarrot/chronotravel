<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

include_once(__DIR__ . "/party.srvr.php");

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            PartyImpl::get()
        )
    ),
    APP_PORT
);

$server->run();
?>
