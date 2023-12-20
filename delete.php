<?php
require_once __DIR__ . "/ManageUsers.php";

if(!isset($_GET["id"]) or empty($_GET["id"])) {
    include_once __DIR__ . "/partials/not_found.php";
    exit;
}
$manage_users = new ManageUsers();
$userId = $_GET["id"];
$user = $manage_users->GetUser($userId);

if(empty($user)) {
    include_once __DIR__ . "/partials/not_found.php";
    exit;
}

//delete image from user
$file = __DIR__ . "/users/images/{$user["id"]}.{$user["extension"]}";

if(file_exists($file)) {
    unlink($file);
}

$manage_users->DeleteUser($user["id"]);
header("Location: index.php");

