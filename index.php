<?php
$contacts = [
  ['name' => 'Miguel', 'phone_number' => 2220222],
  ['name' => 'Angel', 'phone_number' => 339112],
  ['name' => 'Eduardo', 'phone_number' => 97172]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts App</title>
  <link rel="stylesheet" href="http://localhost/PHP/contacts-app /app/css/index.css">
</head>
<body>
  <header>
    <div class="enlaces">
      <a href="#">ContactsApp</a>
      <a href="#">Home</a>
      <a href="./add.php">Add Contact</a>
    </div>
  </header>
  <main class="index">
    <!-- Card de contactos -->
    <?php foreach ($contacts as $contact) { ?>
    <div class="contacto">
      <h3 class="nombre-contacto"><?= $contact['name'] ?></h3>
      <p class="numero-contacto"><?= $contact['phone_number'] ?></p>
      <div class="btns">
        <button class="edit-contacto">Editar</button>
        <button class="borrar-contacto">Borrar</button>
      </div>
    </div>
    <?php } ?>
  </main>
</body>
</html>
