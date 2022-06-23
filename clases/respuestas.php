<?php
session_start();
require_once 'config.php';

class respuestas extends config
{

    private $db;

    public function __construct()
    {

        $this->db = config::Abrir();

    }

    public function Listar()
    {
        $maqv_sql = "SELECT * FROM tbl_respuestas";
        $maqv_stmt = $this->db->prepare($maqv_sql);
        $maqv_stmt->setFetchMode(PDO::FETCH_OBJ);
        $maqv_stmt->execute();
        while ($maqv_row = $maqv_stmt->fetch()) {
            $data = $maqv_row->res_id . '||' . $maqv_row->codfactura . '||' . $maqv_row->mensaje . '||' . $maqv_row->xml . '||' . $maqv_row->idempresa . '||' . $maqv_row->idempresa;
            echo '<tr>';
            echo '<td>' . $maqv_row->res_id . '</td>';
            echo '<td>' . $maqv_row->codfactura . '</td>';
            echo '<td>' . $maqv_row->mensaje . '</td>';
            echo '<td>' . $maqv_row->xml . '</td>';
            


            echo '</tr>';
        }
    }

}