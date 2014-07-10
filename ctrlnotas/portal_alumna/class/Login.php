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

        $sql = "SELECT * FROM `ctrl_alumnos` WHERE `alumn_code`=:usuario AND `contrasena_alum`=md5(:clave) LIMIT 1";

        $stmt = $this->obj->Query($this->db, $sql, $data);
        if ($this->obj->numRows($stmt) == 1) {
            $data = $this->obj->fetchAssoc($stmt);
            $_SESSION['sys_alumno'] = $data[0]['alumn_nomb'];
            $_SESSION['sys_alumno_nom'] = $data[0]['alumn_nomb'];
            $_SESSION['sys_alumno_id'] = $data[0]['id_alumn'];
            $_SESSION['sys_alumno_cod'] = $data[0]['alumn_code'];
            $_SESSION['sys_alumno_cod_gs'] = $data[0]['cod_grado'];
            return true;
        } else {
            return false;
        }
    }

}

?>
