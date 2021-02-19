<?php
class Alumno_model extends CI_model {

public function __construct() {
	parent::__construct();
}

public function get_alumnos() {
	$this->db->order_by( "appaterno, apmaterno, nombre" );
	$rs = $this->db->get( "alumnos" );

	return $rs->result();
}

public function update_posicion( $data ) {
	$this->db->where( "matricula", $data[ "matricula" ] );
	$this->db->update( "alumnos", $data );

	$obj[ "resultado" ] = $this->db->affected_rows() == 1;
	$obj[ "mensaje" ]   = $obj[ "resultado" ] ?
		"Posición actualizada." : "UPS!!! Algó pasó, imposible actualizar.";
	return $obj;
}

public function get_posicion( $matricula ) {
	$this->db->select( "latitud, longitud" );
	$this->db->where( "matricula", $matricula );
	$rs = $this->db->get( "alumnos" );

	$obj[ "resultado" ] = $rs->num_rows() == 1;
	if ( $obj[ "resultado" ] ) {
		$obj[ "mensaje" ]  = "Consulta exitosa.";
		$obj[ "posicion" ] = $rs->row();
	}
	else {
		$obj[ "mensaje" ]  = "Matrícula inexistente.";
	}

	return $obj;
}

}
?>