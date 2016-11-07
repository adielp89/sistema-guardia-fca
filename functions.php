<?php
include('db.php');


class CModel {


// Esta funcion es para coenctarse a la BD y extraer los datos que necesitamos para enviar el mensaje de correo

static public function recolectaDatos($dia,$mes)
{
		$registro = null;
        $query = "select Nombre,email,Carrera,$mes from estudiantes where Dia ='$dia'";
        $result = mysql_query($query); 
      for ($i=0; $i < mysql_num_rows($result) ; $i++) {
      $registro[] = mysql_fetch_array($result);
    }

  return $registro;
  
    }
	
	
	static public function recolectaDatosT($dia)
{
		$registro = null;
        $query = "select Nombre,email,Departamento,Turno from trabajadores where Dia ='$dia'";
        $result = mysql_query($query); 
      for ($i=0; $i < mysql_num_rows($result) ; $i++) {
      $registro[] = mysql_fetch_array($result);
    }

  return $registro;
  
    }


}





?>