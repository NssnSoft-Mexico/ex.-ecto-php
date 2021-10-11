<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ex-ecto</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<?php // Recibe la información del formulario
 
function insert_inputs()
  {
    try {
      
 
      if (!isset($_FILES["archivo"])) {
        throw new Exception("Selecciona un archivo CSV válido.");
      }
 
      $file     = $_FILES["archivo"];
      $tmp      = $file["tmp_name"];
      $filename = $file["name"];
      $size     = $file["size"];
 
      if ($size < 0) {
        throw new Exception("Selecciona un archivo válido por favor.");
      }
 
      $handle = fopen($tmp, "r");
 
      while (($data = fgetcsv($handle)) !== false) {
        $rows[] = $data;
      }
 
      unset($rows[0]); // se eliminan las cabeceras
      $total = count($rows);
       
      if ($total <= 0) {
        throw new Exception("El archivo proporcionado está vacio.");
      }
 
      // Insertando información
      foreach ($rows as $r) {
        $data =
        [
          'titulo'      => $r[0],
          'contenido'   => $r[1],
          'creado'      => $r[2],
          'actualizado' => $r[3],
        ];


        echo "$r[0]";
 
 
      }
      if($data == null) {
        echo '<script language="javascript">alert("No envio datos");</script>';
      }else{
        echo '<script language="javascript">alert("Si envio datos");</script>';
      }
 
    } catch (Exception $e) {
      
    }
  }
?>

<div class="container">
<div class="col-12">
    <div class="card">
      <div class="card-header">Temperaturas</div>
      <div class="card-body">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
        <?php echo insert_inputs(); ?>  
           
          <div class="mb-3">
            <label for="archivo">Selecciona un archivo <code>.csv</code></label>
            <input type="file" class="form-control" name="archivo" id="archivo" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
          </div>
          <button class="btn btn-success" type="submit">Importar</button>
        </form>
      </div>
    </div>
  </div>
</div>




<script src="js/jquery.min.js"></script>
<script src="'js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });      
});
</script>

</body>
</html>