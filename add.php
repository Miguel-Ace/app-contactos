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

      $statement = $conn->prepare("INSERT INTO contacts (name, phone_number) VALUES (:name, :phone_number)");
      // $statement->bindParam(':name', $name);
      // $statement->bindParam(':phone_number', $phone_number);
      $statement->execute([':name' => $name, ':phone_number' => $phoneNumber]);
  
      header('Location: index.php');
    }
  }
?>

<?php require "partials/header.php" ?>

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

<?php require "partials/footer.php" ?>
