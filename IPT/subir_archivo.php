<?php

function insertar_datos($N_IPT,$Ape_Tit,$Nom_Tit,$Departamento,$Seccion,$Paraje,$Tel_Carac,$Tel_Num,$EMail,$Latitud,$Longitud,
                        $Foto,$IPT_Vin1,$IPT_Vin2,$IPT_Vin3,$IPT_Vin4,$Fec_Relev,$Ape_Relev,$Nom_Relev){

    global $conexion;

    $sentencia = "INSERT INTO 1_punto_productivo (N_IPT,Ape_Tit,Nom_Tit,Departamento,Seccion,Paraje,Tel_Carac,Tel_Num,EMail,
                                                  Latitud,Longitud,Foto,IPT_Vin1,IPT_Vin2,IPT_Vin3,IPT_Vin4,Fec_Relev,
                                                  Ape_Relev,Nom_Relev)   
                         values 
                          ($N_IPT,'$Ape_Tit','$Nom_Tit','$Departamento','$Seccion','$Paraje',$Tel_Carac,$Tel_Num,'$EMail',
                           $Latitud,$Longitud,'$Foto',$IPT_Vin1,$IPT_Vin2,$IPT_Vin3,$IPT_Vin4,'$Fec_Relev','$Ape_Relev','$Nom_Relev')";

    $ejecutar = mysqli_query($conexion, $sentencia);
    return $ejecutar;
}

?>