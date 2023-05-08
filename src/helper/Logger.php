<?php
use ES_DataVault\Logger\Logger;
use ES_DataVault\Logger\Level;

global $Logger_vault, $Logger_app, $Logger_http, $Logger_socket, $Logger_admin;

$Logger_vault = new Logger("vault", "logs/", Level::INFO, "vault");
$Logger_admin = new Logger("admin", "logs/", Level::INFO, "admin");
$Logger_db = new Logger("db", "logs/", Level::INFO, "db");
$Logger_sys = new Logger("sys", "logs/", Level::INFO, "sys");
$Logger_app = new Logger("app", "logs/", Level::INFO, "app");
$Logger_http = new Logger("http", "logs/", Level::INFO, "http");
$Logger_socket = new Logger("socket", "logs/", Level::INFO, "socket");