<?php

class Login {

    protected   $db;
    protected   $obj;
    public	$paginator;
    public 	$total;

    public function __construct($_obj) {
        if (is_object($_obj)) {
            $this->obj = $_obj;
            $this->db = $this->obj->Connect();
        } else {
            return false;
        }
    }

    public function access() {

        $data = array(
            'usuario' => $_POST['username'],
            'clave' => $_POST['adminpassword']
        );

        $sql = "SELECT * FROM `ctrl_docentes` WHERE `dcnt_user`=:usuario AND `dcnt_pwd`=md5(:clave) LIMIT 1";

        $stmt = $this->obj->Query($this->db, $sql, $data);
        if ($this->obj->numRows($stmt) == 1) {
            $data = $this->obj->fetchAssoc($stmt);
            $_SESSION['sys_docente'] = $data[0]['dcnt_user'];
            $_SESSION['sys_docente_nom'] = $data[0]['dcnt_nom'];
            $_SESSION['sys_docente_ape'] = $data[0]['dcnt_ape'];
            $_SESSION['sys_docente_id'] = $data[0]['dcnt_id'];
            return true;
        } else {
            return false;
        }
    }

   
}

?>
