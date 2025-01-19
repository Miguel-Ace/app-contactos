<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = [
      'name' => $_POST['name'],
      'phone_number' => $_POST['phone_number'],
    ];

    if (file_exists('contacts.json')) {
      $contacts = json_decode(file_get_contents("contacts.json"), true);
    }else{
      $contacts = [];
    }

    $contacts[] = $contact;

    file_put_contents("contacts.json", json_encode($contacts));

    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts App</title>
  <link rel="stylesheet" href="http://localhost/PHP/contacts-app/app/css/index.css">
</head>
<body>
  <header>
    <div class="enlaces">
      <a href="#">ContactsApp</a>
      <a href="./index.php">Home</a>
      <a href="#">Add Contact</a>
    </div>
  </header>
  <main class="add">
     <div class="formulario">
      <div class="encabezado-form">
        <p>Agregar Nuevo Contacto</p>
      </div>
      <form method="post" action="add.php">
        <div class="input">
          <label for="name">Nombre</label>
          <input type="text" id="name" name="name">
        </div>
        
        <div class="input">
          <label for="phone_number">Teléfono</label>
          <input type="text" id="phone_number" name="phone_number">
        </div>

        <div class="btns">
          <button class="btn-enviar-form">Guardar</button>
        </div>
      </form>
     </div>
  </main>
</body>
</html>
