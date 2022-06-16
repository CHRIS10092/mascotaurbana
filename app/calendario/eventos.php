<?php

header('Content-Type: application/json');
$conectar = new PDO('mysql:dbname=veter;host=localhost', 'root', '');

//si existe la variable accion que me cree la accion si que me lea la accion
//print_r($_POST);
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
switch ($accion) {
    case 'agregar':
        //echo "agre";

        $sql1 = "SELECT title,start from eventos where title='" . $_POST['txtTitulo'] . "' AND start='" . $_POST['txtFecha'] . ' ' . $_POST['txtHora'] . "' ";
        $res = $conectar->prepare($sql1);
        $res->execute();
        $respues = $res->rowCount();

        if ($respues > 0) {
            //print_r(json_encode(false));

        } else {

            $sql = "INSERT INTO eventos( `title`, `descripcion`, `color`, `textColor`, `start`, `end`) 
        VALUES (:title,:descripcion,:color,:textColor,:start,:end)";
            $sentenciaSQL = $conectar->prepare($sql);
            $stmt = $sentenciaSQL->execute(array(
                "title" => $_POST['txtTitulo'],
                "descripcion" => $_POST['txtDescripcion'],
                "color" => $_POST['txtColor'],
                "textColor" => '#FFFFFF',
                "start" => $_POST['txtFecha'] . ' ' . $_POST['txtHora'],
                "end" => $_POST['txtFecha'] . ' ' . $_POST['txtHora']

            ));
            print_r(json_encode($stmt));
        }
        break;
    case 'eliminar':
        $respuesta = false;

        // isset = hay algo en el id cuando me lo enviaste?
        if (isset($_POST['txtId'])) {
            $sentenciaSQL = $conectar->prepare("DELETE FROM eventos WHERE id=:id");
            $respuesta = $sentenciaSQL->execute(array("id" => $_POST['txtId']));
        }
        echo json_encode($respuesta);


        break;


    case 'modificar':
        $sentenciaSQL = $conectar->prepare(("UPDATE eventos SET
             title =:title,
             descripcion=:descripcion,
             color=:color,
             textColor=:textColor,
             start=:start,
             end=:end
             WHERE id=:id
             "));

        $respuesta = $sentenciaSQL->execute(array(
            "id" => $_POST['txtId'],
            "title" => $_POST['txtTitulo'],
            "descripcion" => $_POST['txtDescripcion'],
            "color" => $_POST['txtColor'],
            "textColor" => '#FFFFFF',
            "start" => $_POST['txtFecha'] . ' ' . $_POST['txtHora'],
            "end" => $_POST['txtFecha'] . ' ' . $_POST['txtHora']
        ));

        echo json_encode($respuesta);

        break;

    default:

        // selecionar los envetos 
        $sentencia = $conectar->prepare("SELECT * FROM eventos");
        $sentencia->execute();
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($resultado));
        break;
}