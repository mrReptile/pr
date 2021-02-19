<!DOCTYPE html>
<HTML>
<HEAD>
	<TITLE>Práctica 4</TITLE>
	<META charset="UTF-8">
	<LINK href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<LINK href="<?= base_url() ?>static/fontawesome/css/all.min.css" rel="stylesheet">
	<SCRIPT src="<?= base_url() ?>static/js/jquery-3.4.1.min.js"></SCRIPT>
	<SCRIPT src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></SCRIPT>
	<SCRIPT src="<?= base_url() ?>static/js/alumnos.js"></SCRIPT>
	<SCRIPT>
		var base_url = "<?= base_url() ?>";
	</SCRIPT>

</HEAD>
<BODY>

<DIV class="container">
	<DIV class="row">
		<DIV class="col col-md-8">
			<H3>Práctica 4</H3>
		</DIV>
	</DIV>
	<DIV class="row">
		<DIV class="col col-md-8">
			<TABLE class="table table-stripped table-hover">
				<TR class="text-white bg-info">
					<TH>Matrícula</TH>
					<TH>Nombre</TH>
					<TH>Sexo</TH>
					<TH>Edad</TH>
					<TH>Domicilio</TH>
				</TR>
			<?php foreach ( $alumnos as $alumno ) : ?>
				<TR>
					<TD><?= $alumno->matricula ?></TD>
					<TD><?= $alumno->appaterno ?>
						<?= $alumno->apmaterno ?>
						<?= $alumno->nombre ?></TD>
					<TD class="text-center"><?= $alumno->sexo ?></TD>
					<TD class="text-right"><?= $alumno->edad ?></TD>
					<TD class="text-center">
						<BUTTON 
							class="btn btn-danger"
							data-toggle="modal"
							data-target="#modal-mapa"
							title="Localiza domicilio"
							onclick="abre_mapa('<?= $alumno->matricula ?>','<?= $alumno->appaterno ?> <?= $alumno->apmaterno ?> <?= $alumno->nombre ?>')"><I class="fas fa-map-marked-alt fa-2x"></I>
						</BUTTON>
					</TD>
				</TR>
			<?php endforeach; ?>
			</TABLE>
		</DIV>
	</DIV>
</DIV>

<!-- Modal MAPA -->
<div class="modal fade" id="modal-mapa">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #97C9FF !important;">
        <h5 class="modal-title"><SPAN id="titulo-grafica">Mapa de domicilio</SPAN>
        <SMALL><SMALL>
		<br>
		<B>Alumno: </B>
        	<SPAN id="modal-mapa-titulo"></SPAN>
        	(<SPAN id="modal-mapa-matricula"></SPAN>)
        </SMALL></SMALL></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	<DIV class="row">
			<DIV class="col col-md-12">
				<DIV id="alerta"></DIV>
			</DIV>
		</DIV>

      	<div style="margin: auto;" class="text-center"><STRONG>Haz click / arrastra y suelta el marcador para guardar la posición</STRONG></div>
      	<div id="mapa" style="width: 600px !important; height: 400px !important; margin: auto;"></div>
      </div>

    </div>
  </div>
</div>

<SCRIPT async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHihiG2sLePt8cB8u61qTRg_PRUGnROkA&callback=iniciaMapa">
</SCRIPT>

</BODY>
</HTML>