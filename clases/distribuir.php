<?php
/**
 *
 */
require_once "config.php";
class distribuir extends config
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = config::Abrir();
    }

    public function listar_tipos()
    {
        $sql = "SELECT * FROM tipo_articulo ";
        $ps  = $this->dbh->prepare($sql);
        $ps->execute();
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function listar_articulos($tipo)
    {
        $sql = "SELECT * FROM tbl_articulos WHERE idtipoarticulo=:tipo";
        $ps  = $this->dbh->prepare($sql);
        $ps->execute(["tipo" => $tipo]);
        $rs = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function insertardistri($datos)
    {
        //$valor = 0;
        $sql = "INSERT INTO tbl_distribucion(idarticulo,idempresa,dis_cantidad,dis_precio,dis_valor) values (?,?,?,?,?)";
        $ps  = $this->dbh->prepare($sql);
        $ps->bindParam(1, $datos[0]);
        $ps->bindParam(2, $datos[1]);
        $ps->bindParam(3, $datos[2]);
        $ps->bindParam(4, $datos[3]);
        $ps->bindParam(5, $datos[3]);

        $d = $ps->execute();
        return $d;

    }

    public function stock_articulo($id)
    {
        $sql = "SELECT art_stock FROM tbl_articulos WHERE art_id=:id";
        $ps  = $this->dbh->prepare($sql);
        $ps->execute(["id" => $id]);
        $articulo = new stdClass();
        while ($row = $ps->fetch()) {
            $articulo->stock = $row["art_stock"];
        }

        return $articulo;
    }

    public function actualizar_stock($articulo, $cantidad)
    {
        $sql = "UPDATE tbl_articulos  SET art_stock=:cantidad WHERE art_id=:articulo ";
        $ps  = $this->dbh->prepare($sql);
        $ps->execute([
            "cantidad" => $cantidad,
            "articulo" => $articulo,
        ]);

    }

}
