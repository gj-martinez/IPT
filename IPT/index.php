<?php 
        if(isset($_POST["enviar"])){
            require_once("conexion.php");
            require_once("subir_archivo.php");

            $archivo= $_FILES["archivo"]["name"];
            $archivo_copiado = $_FILES["archivo"]["tmp_name"];
            $archivo_guardado = "copia_".$archivo;
            
            if(copy($archivo_copiado, $archivo_guardado)){
                echo " se copio corractamente el archivo temporal a nuestra carpeta de trabajo";
            }else{
                echo "hubo un error";
            }

            if(file_exists($archivo_guardado)){

                $fp = fopen($archivo_guardado,"r");
                $row = 0;
                
                while(($datos = fgetcsv($fp,1000,";")) !== FALSE){
                    $row ++;
                    if($row > 1){
                
                        $numero = count($datos);
                        
                        for($r = 0; $r < $numero; $r++ ){
                            if($datos[$r] == ""){

                                $datos[$r] = "null";
                            
                            }
                        }
                    
                        $resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],
                                                    $datos[9],$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15],$datos[16],
                                                    $datos[17],$datos[18]);
                                                    
                        if($resultado){
                        
                          //  echo "se inserto correctamente </br>";
                            
                        }else{
                            echo "no se inserto </br>";
                        }
                        
                    }

                }

            }else{
                echo " no existe el archivo copiado";
            }


        }
         
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="index.css">
    
    <title>IPT</title>
    
  </head>
  <body>
  <div>
       <img src="iptjpg.jpg" alt="ipt" class="imagen">        
        </div>


        <div class="formulario">
            <select name="cmbformulario" class="combox">
                <option value="PuntoProductivo"> Punto Productivo</option>
                <option value="Siembra"> Siembra </option>
                <option value="Cosecha"> Cosecha</option>
                <option value="Plantacion"> Plantaciòn</option>
            </select>
            <form action="index.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
                <input type="file" name="archivo" class="button1">
                <input type="submit" value="Subir Archivo" class="button2" name="enviar">
            </form>
        </div>

        <div class="contenedor">
            <div class="col-md-11 col-md-offset-8">
                <table id="example" class="table table-hover  display" >
                            <thead >
                                <tr >
                                    <th >Numero IPT</th>
                                    <th >Apellido</th>
                                    <th >Nombre</th>
                                    <th >Departamento</th>
                                    <th >Secciòn</th>
                                    <th >Paraje</th>
                                    <th >Telefono</th>
                                    <th >IPT Vinculado 1</th>
                                    <th >IPT Vinculado 2</th> 
                                    <th >IPT Vinculado 3</th>
                                    <th >IPT Vinculado 4</th>


                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = new mysqli("localhost","root","","ipt");
                                    $sentencia = ("SELECT * FROM 1_punto_productivo");
                                    
                                    $efecto = $con -> query($sentencia);
                                    if($efecto -> num_rows > 0){

                                            while($fila = $efecto -> fetch_assoc()){
                                                $n_ipt = $fila['N_IPT'];
                                                $apellido = $fila['Ape_Tit'];
                                                $nombre = $fila['Nom_Tit'];
                                                $departamento = $fila['Departamento'];
                                                $seccion = $fila['Seccion'];
                                                $paraje = $fila['Departamento'];
                                                $tel_car = $fila['Tel_Carac'];
                                                $tel_num = $fila['Tel_Num'];
                                                $ipt_vin1 = $fila['IPT_Vin1'];
                                                $ipt_vin2 = $fila['IPT_Vin2'];
                                                $ipt_vin3 = $fila['IPT_Vin3'];
                                                $ipt_vin4 = $fila['IPT_Vin4'];


                                ?>

                                            <tr>
                                                <td><?= $n_ipt ?></td>
                                                <td><?= $apellido ?></td>
                                                <td><?= $nombre ?></td>
                                                <td><?= $departamento ?></td>
                                                <td><?= $seccion ?></td>
                                                <td><?= $paraje ?></td>
                                                <td><?= $tel_car ."-". $tel_num?></td>
                                                <td><?= $ipt_vin1 ?></td>
                                                <td><?= $ipt_vin2 ?></td>
                                                <td><?= $ipt_vin3 ?></td>
                                                <td><?= $ipt_vin4 ?></td>
                                            </tr>

                                    <?php
                                        }

                                    }

                                    
                                    ?>
                            </tbody>
                    </table>
                </div>    
            </div>
        
        
    </div>                      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.main.js" ></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable({
                "scrollY": '50vh',
                "scrollX": true,
                "scrollCollapse": true,
                "paging": false
            });
        });
    </script>

  
</body>
</html>