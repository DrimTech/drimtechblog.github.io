<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

require_once 'DBcontenidos_connect.php';

	if($_FILES['imagen']['error']){
		switch ($_FILES['imagen']['error']) {
			case 1:
				echo "El tamaño del archivo excede lo permitido por el servidor";
				break;
			
			case 2:
				echo "El tamaño del archivo excede 2 MB";
				break;

			case 3:
				echo "El envío de archivo se interrumpió";
				break;

			case 4:
				echo "No se ha enviado ningún archivo de imagen";
				break;
		}
		
	} else {
		echo "Entrada subida con éxito <br>";

		if((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error']==UPLOAD_ERR_OK))) {

			$destino_de_ruta ="postsimg/";

			move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);

			echo "El archivo " . $_FILES['imagen']['name'] . " se ha copiado en el directorio de imágenes <br>";
		} else {

			echo "El archivo no se ha podido copiar al directorio de imágenes";

		}
	}

	$eltitulo 	= $_POST['campo_titulo'];
	$lafecha 	= date("Y-m-d H:i:s");
	$elcomentario = $_POST['area_comentarios'];
	$laimagen = $_FILES['imagen']['name'];
	$categoria = $_POST['seleccion'];

	$miconsulta = "INSERT INTO CONTENIDO (Titulo, Fecha, Comentario, Imagen, categoria) VALUES ('" . $eltitulo ."', '" . $lafecha ."', '" . $elcomentario ."', '". $laimagen ."', '". $categoria ."')";


	$resultado=mysqli_query($miconexion, $miconsulta);

	/*Cierra conexión*/

	mysqli_close($miconexion);

	echo "<br> Se ha agregado el comentario con éxito,<br><br>";
?>

</body>
</html>