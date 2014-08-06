<?php

include("config.php");

class db{

	private $link;

	function db(){
		$this->link = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB);
			
		if($this->link->connect_errno){
			echo "No se pudo conectar: " . mysqli_connect_errno();
		}
		else{
			echo "Conectado correctamente a " . DB_SERVER . ", BD " .DB;
		}
		echo "<br/>";
	}

	function desconectar(){
		// Cerrar la conexión
		mysqli_close($this->link);
	}

	function mostrarTabla($tabla){
		$query = "SELECT * FROM $tabla";
		$result = mysqli_query($this->link, $query);

		echo "<table border = '1'>\n";

		echo "<tr>";
		while ($fieldinfo = mysqli_fetch_field($result)){
			echo "<th>";
			echo $fieldinfo->name;
			echo "</th>";
		}
		echo "</tr>";

		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			for ($i = 0; $i < mysqli_num_fields($result); $i++) {
				echo "<td>" . $row[$i] . "</td>";
			}
			echo "</tr>";
		}

		echo "</table>";

		// Liberar resultados
		mysqli_free_result($result);
	}

	function insertarAnuncio($titulo, $descripcion, $mail, $imagen){
		$query = "INSERT INTO ".DB_ANUNCIOS." (".T_ANUNCIOS_TITULO.", ".T_ANUNCIOS_DESCRIPCION.", ".T_ANUNCIOS_EMAIL.") VALUES('$titulo', '$descripcion', '$mail')";

		if(mysqli_query($GLOBALS["link"], $query)){
			echo "Se ha insertado corretamente el anuncio, $titulo";
		}
		else{
			die ("No ha sido posible insertar el anuncio, $titulo. " . mysqli_error($GLOBALS["link"]) . ". " . mysqli_errno($GLOBALS["link"]));
		}

		$query = "INSERT INTO ".DB_IMAGENES." (".T_IMAGENES_IMAGEN.") VALUES('$imagen')";

		if(mysqli_query($GLOBALS["link"], $query)){
			echo "Se ha insertado corretamente la imagen del anuncio  $titulo";
		}
		else{
			die ("No ha sido posible insertar la imagen del anuncio  $titulo. " . mysqli_error($GLOBALS["link"]) . ". " . mysqli_errno($GLOBALS["link"]));
		}

		echo "<br/>";
	}
}

?>