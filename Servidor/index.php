<?php

switch ($_REQUEST ["opcion"]) {
	case '1' :
		echo "Ha elegido la opcion $_REQUEST[opcion], mostrar tabla " . DB_IMAGENES;
		echo ".<br/>";

		mostrarTabla ( DB_IMAGENES );
		// desconectar();
		break;
	case '2' :
		echo "Ha elegido la opcion $_REQUEST[opcion], mostrar tabla " . DB_ANUNCIOS;
		echo ".<br/>";

		mostrarTabla ( DB_ANUNCIOS );
		break;
	case '3' :
		echo "Ha elegido la opcion $_REQUEST[opcion], insertar anuncio.";
		echo "<br/>";

		$titulo = mysqli_real_escape_string($GLOBALS["link"], $_REQUEST ['titulo']);
		$descripcion = mysqli_real_escape_string($GLOBALS["link"], $_REQUEST ['descripcion']);
		$emai = mysqli_real_escape_string($GLOBALS["link"], $_REQUEST ['email'] );
		$imagen = base64_decode(mysqli_real_escape_string($GLOBALS["link"], $_REQUEST['foto']));

		insertarAnuncio ( $titulo, $descripcion, $email, $imagen );
		mostrarTabla ( DB_ANUNCIOS );
		break;
	case '4' :
		echo "Ha elegido la opcion $_REQUEST[opcion], actualizar usuario.";
		echo "<br/>";


		break;
	default :
		echo "La opcion: $_REQUEST[opcion] es incorrecta.";
		echo "<br/>";
		break;
}

?>