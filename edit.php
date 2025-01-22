 <?php
  require "database.php";

  $id = $_GET['id'];

  $statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
  $statement->execute([':id' => $id]);

  $contact = $statement->fetch(PDO::FETCH_ASSOC);

  if (!$contact) {
      http_response_code(404);
      echo "HTTP 404 NOT FOUND";
      return;
  }

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['phone_number'])) {
      $error = "Completar los campos";
    }elseif(strlen($_POST['phone_number']) < 9){
      $error = "9 o más";
    }else{
      $name = $_POST['name'];
      $phoneNumber = $_POST['phone_number'];
  
      $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id = :id");
      $statement->execute(['id' => $id, ':name' => $name, ':phone_number' => $phoneNumber]);
  
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
      <a href="./add.php">Add Contact</a>
    </div>
  </header>
  <main class="add">
     <div class="formulario">
      <div class="encabezado-form">
        <p>Editar Contacto</p>
      </div>
      <form method="post" action="edit.php?id=<?= $id ?>">
        <?php if ($error) { ?>
          <p><?= $error ?></p>
        <?php } ?>
        
        <div class="input">
          <label for="name">Nombre</label>
          <input type="text" id="name" name="name" value="<?= $contact['name'] ?>">
        </div>
        
        <div class="input">
          <label for="phone_number">Teléfono</label>
          <input type="text" id="phone_number" name="phone_number" value="<?= $contact['phone_number'] ?>">
        </div>

        <div class="btns">
          <button class="btn-enviar-form">Guardar</button>
        </div>
      </form>
     </div>
  </main>
</body>
</html>
