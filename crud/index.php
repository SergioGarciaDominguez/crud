<?php
  header('Content-Type: text/html; charset=UTF-8');

  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = '';
  $db_name = 'crud';
  $db_table_name = 'sai';
  $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
  $respuesta = '';

  $forCreate = isset($_POST['forCreate_x']);
  $forUpdate = isset($_POST['forUpdate_x']);
  $forDelete = isset($_POST['forDelete_x']);
  $create = isset($_POST['create']);
  $update = isset($_POST['update']);
  $delete = isset($_POST['delete']);

  foreach ($_POST as $clave => $valor) {
      $$clave = htmlspecialchars($valor);

    ${"validacion_$clave"} = true;

  }

  $validacion = true;

  if ($forCreate) {
    $cssCreate = '<style scoped="scoped">.d-saiId {display: none;} #d-create {display:block;} #d-update {display:none;}</style>';
  } else if ($forUpdate) {
    $id = $sai_id;
    $cssUpdate = '<style scoped="scoped">#d-update {display:block;} #d-create {display:none;}</style>';
  } else if ($forDelete) {

  } else if ($create) {
    $query = "INSERT INTO `$db_name`.`$db_table_name` (`marca` , `modelo` , `vatios` , `precio` ) VALUES (\"$marca\", \"$modelo\", \"$vatios\", \"" . str_replace(',', '.', $precio) . '")';
  } else if ($update) {
    $query = "UPDATE `$db_name`.`$db_table_name` SET marca='$marca', modelo='$modelo', vatios='$vatios', precio=" . str_replace(',', '.', $precio) . " WHERE sai_id=$id";
  } else if ($delete) {
    $query = "DELETE FROM `$db_name`.`$db_table_name` WHERE sai_id=$id";
  }

  if ($create || $update || $delete) {
    $result = mysqli_query($db_connection, $query);

    if (!$result) {
      echo 'ERROR EN LA QUERY';
    }
  }

  $queryCampos = "SHOW COLUMNS FROM `$db_name`.`$db_table_name`";
  $queryRegistros = "SELECT * FROM `$db_name`.`$db_table_name`";

  $resultCampos = mysqli_query($db_connection, $queryCampos);
  $resultRegistros = mysqli_query($db_connection, $queryRegistros);
  $campos = array();

?>

<!DOCTYPE html>
<html class="no-js" lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Gestión de SAI</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <div class="wrapper"> <!-- 1170px -->
      <header class="header">
        <img class="logo" src="img/logo.png" />
        <div class="title">
          <h1>GESTIÓN DE SAI</h1>
          <span>Sistemas de Alimentación Ininterrumpida<span>
        </div>
      </header>
      <section class="content">
        <div id="respuesta">
          <?php //if ($filtrado) {echo $respuesta;} ?>
        </div>
        <?php //if ($filtrado) {echo $respuestaCss;} ?>
        <table id="tabla">
          <?php while ($row = mysqli_fetch_array($resultCampos)):
            array_push($campos, $row[0]);
            $elemento = implode(' ', explode('_', $row[0])); ?>
            <th><?= ucfirst($elemento) ?></th>
          <?php endwhile; ?>
          <th>Acción</th>
          <?php while ($row = mysqli_fetch_row($resultRegistros)): ?>
            <tr>
              <form id="registro<?= $row[0] ?>" class="f-row" method="post" action="index.php">
                <?php for ($i = 0; $i < count($campos); $i++):
                  if ($campos[$i] == 'precio') {$valor = str_replace('.', ',', $row[$i]);} else {$valor = $row[$i];} ?>
                  <input type="hidden" name="<?= $campos[$i] ?>" class="<?= $campos[$i] ?>" value="<?= $valor ?>" /><td><?= $valor ?></td>
                <?php endfor; ?>
                <td><input type="image" src="img/ojo.png" alt="Modificar" name="forUpdate" height="18px" width="22px" />  <input type="image" src="img/borrar.png" alt="Borrar" name="forDelete" height="16px" width="16px" /></td>
            </form>
          </tr>
          <?php endwhile; ?>
        </table>
        <form id="f-create" method="post" action="index.php">
          <label><input type="image" src="img/anadir.png" height="20px" width="20px" alt="" name="forCreate" />  Añadir registro</label>
        </form>
        <form id="mensaje-eliminar" action="index.php" method="post">
          <input id='e-id' name='id' type='hidden' value='<?= $sai_id ?>' />
          ¿Está seguro de que desea borrar el registro actual?
          <a href="index.php"><button id="e-cancel" class="button" type="button">Cancelar</button></a>
          <input id="e-delete" class="d-submit" name="delete" type="submit" value="Eliminar" />
        </form>
        <form id="detalle" action="index.php" method="post">
            <div id="d-respuesta">
              Error, revise los datos introducidos.
            </div>
          <fieldset>
            <div class="d-saiId">
              <label for="d-saiId">Id SAI</label>
              <input id="d-saiId" disabled="disabled" min="1" name="sai_id" type="number" value="<?php
                  if ($forUpdate) {echo htmlspecialchars($id);} ?>" />
              <?php if ($forUpdate || !$validacion) {
                echo "<input id='d-id' name='id' type='hidden' value='$id' />";
              } ?>
            </div>
            <div id="aviso-d-marca" class="d-aviso">
              <span><?php if (($update || $create) && !$validacion_marca)
                {echo $aviso_marca;} ?></span>
            </div>
            <?php if (($update || $create) && !$validacion_marca) {echo $cssAviso_marca;} ?>
            <div>
              <label for="d-marca">Marca</label>
              <input id="d-marca" name="marca" required="required" type="text" value="<?php
                  if ($forUpdate || !$validacion) {echo htmlspecialchars($marca);} ?>" />
            </div>
            <div id="aviso-d-modelo" class="d-aviso">
              <span><?php if (($update || $create) && !$validacion_modelo)
                {echo $aviso_modelo;} ?></span>
            </div>
            <?php if (($update || $create) && !$validacion_modelo) {echo $cssAviso_modelo;} ?>
            <div>
              <label for="d-modelo">Modelo</label>
              <input id="d-modelo" name="modelo" required="required" type="text" value="<?php
                  if ($forUpdate || !$validacion) {echo htmlspecialchars($modelo);} ?>" />
            </div>
            <div id="aviso-d-vatios" class="d-vatios">
              <span><?php if (($update || $create) && !$validacion_vatios)
                {echo $aviso_vatios;} ?></span>
            </div>
            <?php if (($update || $create) && !$validacion_vatios) {echo $cssAviso_vatios;} ?>
            <div>
              <label for="d-vatios">Vatios</label>
              <input id="d-vatios" name="vatios" min="1" max="99999" required="required" type="number" value="<?php
                  if ($forUpdate || !$validacion) {echo htmlspecialchars($vatios);} ?>" />
            </div>
            <div id="aviso-d-precio" class="d-precio">
              <span><?php if (($update || $create) && !$validacion_precio)
                {echo $aviso_precio;} ?></span>
            </div>
            <?php if (($update || $create) && !$validacion_precio) {echo $cssAviso_precio;} ?>
            <div>
              <label for="d-precio">Precio</label>
              <input id="d-precio" name="precio" required="required" type="text" value="<?php
                  if ($forUpdate || !$validacion) {echo htmlspecialchars($precio);} ?>" />
            </div>
            <input id="d-create" class="d-submit" name="create" type="submit" value="Añadir" />
            <?php if ($forCreate || $create && !$validacion) {echo $cssCreate;} ?>
            <input id="d-update" class="d-submit" name="update" type="submit" value="Modificar" />
            <?php if ($forUpdate || $update && !$validacion) {echo $cssUpdate;} ?>
            <a href="index.php">
              <button id="d-cancel" class="button" type="button">Cancelar</button>
            </a>
          </fieldset>
        </form>
      </section>
      <footer class="footer">
        <p>CRUD by Sergio García Domínguez</p>
      </footer>
    </div>

    <?php if ($forCreate || $forUpdate || !$validacion): ?>
      <style>
        #tabla, #f-create {
          display:none;
        }

        #detalle {
          display: block !important;
        }
      </style>
    <?php endif; ?>

    <?php if ($forDelete): ?>
      <style>
        #mensaje-eliminar {
          display:block !important;
        }
        #tabla, #f-create {
          display:none ! important;
        }
      </style>
    <?php endif; ?>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/jquery-ui.js"></script>
  </body>
</html>
