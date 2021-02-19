<?php
class Alumno extends CI_Controller {

public function __construct() {
	parent::__construct();
	$this->load->model( "Alumno_model" );
}

public function index() {
	$data[ "alumnos" ] = $this->Alumno_model->get_alumnos();
	$this->load->view( "alumnos_view", $data );
}

public function cambiapos() {
	$matricula = $this->input->post( "matricula" );
	$latitud   = $this->input->post( "latitud" );
	$longitud  = $this->input->post( "longitud" );
	$data = array(
		"matricula" => $matricula,
		"latitud"   => $latitud,
		"longitud"  => $longitud
	);

	$obj = $this->Alumno_model->update_posicion( $data );

	$this->output->set_content_type( "application/json" );
	echo json_encode( $obj );
}

public function getpos() {
	$obj = $this->Alumno_model->get_posicion( $this->input->post( "matricula" ) );

	$this->output->set_content_type( "application/json" );
	echo json_encode( $obj );
}

}
?>