<?php 
include "../conectar.php" ;
$activo = "Anotaciones por mes";
?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="/SistemaOdonto/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/SistemaOdonto/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="/SistemaOdonto/js/bootstrap.min.js"></script>
          <!-- fin cosas de Bootstrap -->
          <title>Anotaciones  </title>
          <style type="text/css"> 
        body { 
            background:#FFFFFF;
            background-repeat: repeat;
            padding-top:90px;
        } 
        </style>      
   </head>
   <body> 
       <!-- aca van las cosas de la barra --> 
   <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
           <div class="container">
            <a class="brand" href="/SistemaOdonto/index.php">Historias clinicas  </a>
            <ul class="nav">
                <li class="<?php echo ($activo == "paciente") ? 'active' : ''; ?>"><a href="/SistemaOdonto/paciente/busquedapaciente.php">Pacientes</a></li>
                <li class="<?php echo ($activo == "Anotaciones por mes") ? 'active' : ''; ?>"><a href="/SistemaOdonto/anotaciones/anotacionpormes.php">Anotaciones por mes</a></li>
            </ul>
           </div>
        </div>
   </div>
       <!-- fin de la  barra -->
       <div class="container" >
       <!-- TABLA PARA MOSTRAR CONTENIDO (beta) -->
         <table class="table table-bordered table-hover ">
            <thead>
              <tr>
                <th>MES</th>
                <th>NOTAS</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              //-----------------------
                function recortar_texto($texto, $limite=100){   
                $texto = trim($texto);
                $texto = strip_tags($texto);
                $tamano = strlen($texto);
                $resultado = '';
                if($tamano <= $limite){
                    return $texto;
                }else{
                    $texto = substr($texto, 0, $limite);
                    $palabras = explode(' ', $texto);
                    $resultado = implode(' ', $palabras);
                    $resultado .= '...';
                }   
                return $resultado;
                }
                //---------------------
                $query = "SELECT * FROM anotacionesMes";
                $result = mysql_query($query);
                while ($row =  mysql_fetch_array($result)){
                ?>
                <tr>
                  <td id="centrado"><?php echo $row['mes']?></td>
                  <?php if ($row['nota'] != ""){?>
                    <td id="centrado"><?php echo recortar_texto($row['nota'], 80)?><a href="verNota.php?id=<?php echo $row['id']?>">Ver Más</a></td>
                  <?php }else{ ?>
                    <td id="centrado"></td>
                  <?php } ?>
                  <td>
                    <?php if ($row['nota'] == ""){?>
                    <a href="nuevanota.php?id= <?php echo$row['id'];?>">NUEVA </a>
                    <?php }else { ?>
                    <a href="editarnota.php?id= <?php echo$row['id'];?>">EDITAR </a>
                    <a href="borrarnota.php?id= <?php echo$row['id'];?>">ELIMINAR </a>
                    <?php } ?>
                  </td>
                </tr>
                <?php
                }
              ?>
            </tbody>
         </table> 
       </div>

       

</html>
   