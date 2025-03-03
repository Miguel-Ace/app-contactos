<?php

require "database.php";

$id = $_GET['id'];

$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id");

$statement->execute([':id' => $id]);

$contact = $statement->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    http_response_code(404);
    echo "HTTP 404 NOT FOUND";
    return;
}

$conn->prepare("DELETE FROM contacts WHERE id = :id")->execute([':id' => $id]);

header('Location: index.php');