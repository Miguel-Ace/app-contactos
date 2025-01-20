<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['phone_number'])) {
      $error = "Completar los campos";
    }elseif(strlen($_POST['phone_number']) < 9){
      $error = "9 o más";
    }else{
      $name = $_POST['name'];
      $phoneNumber = $_POST['phone_number'];
  
      $statement = $conn->prepare("INSERT INTO contacts (name, phone_number) VALUES (':name', ':phone_number')");
      $statement->bindParam(':name', $name);
      $statement->bindParam(':phone_number', $phone_number);
      $statement->execute();
  
      header('Location: index.php');
    }
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
        <?php if ($error) { ?>
          <p><?= $error ?></p>
        <?php } ?>
        
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
