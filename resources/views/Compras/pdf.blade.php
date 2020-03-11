<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Presupuesto</title>
		<style media="screen" type="text/css" rel="stylesheet">
			body {
				font-size: 1em;
			}

			table {
					border-collapse: collapse;
					border: 0.5px solid;
					margin-bottom: 1em;
					width: auto;
			}

			table tr {
					page-break-inside: avoid;
			}

			table thead tr td {
					background-color: #F0F0F0;
					border: 1px solid #DDDDDD;
					min-width: 0.6em;
					padding: 5px;
					text-align: left;
					vertical-align: top;
					font-weight: bold;
			}

			table tbody tr td {
					border: 1px solid #DDDDDD;
					min-width: 0.6em;
					padding: 5px;
					vertical-align: top;

			}

			tbody tr.even td {
					background-color: transparent;
			}
			}

		</style>

	</head>
	<body>
	<div style="background-color: white; color: black;" class="container">
		<div style="font-size: 12px" class="row">
      <div class="col-sm-4">
        <div style="border-style: hidden;position:absolute;margin:5% 5%;" class="card">
          <div style="margin: 0 auto;" class="card-body">
            {taller_lototipo}
          </div>
        </div>
      </div>
      <div class="col-sm-4">
				<div style="border-style: hidden;margin:0 30%;position: absolute;width:30%" class="card">
					<div style="text-align: right;" class="card-body">
						<h5 style="font-size: 14px" class="card-title">{taller_nomb}</h5>
						<p class="card-text">{taller_ubic_long}</p>
						<p class="card-text">{taller_direccion} {taller_numero}</p>
						<p class="card-text">{gos_region_municipio_id->nomb_municipio}</p>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div style="border-style:hidden;text-align:right;margin: 0 10%" class="card">
					<div class="card-body">
						<h5 style="font-size: 14px"class="card-title">Juan Perez</h5>
						<p class="card-text">Taller Montecarlo</p>
						<p class="card-text">336482758475</p>
					</div>
				</div>
			</div>
		</div>
		<!--begin::Section-->
		<div style="font-size: 12px" class="kt-section">
			<div class="kt-section__content">
				<div class="table-responsive">
					<table style="text-align: center;margin:10% auto;width:80%; "
						class="table table-bordered">
						<thead>
							<tr style="background-color:rgb(240,240,240);">
								<th colspan="7" scope="col">Número de órden : <span
									style="font-weight: bold;">{orden_id}</span></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Marca</th>
								<td style="font-weight: bold;">Modelo</td>
								<td style="font-weight: bold;">Año</td>
								<td style="font-weight: bold;">Color</td>
								<td style="font-weight: bold;"># de placa</td>
								<td style="font-weight: bold;"># de serie</td>
							</tr>
							<tr>
								<th style="font-weight: normal;" scope="row">{nomb_marca}</th>
								<td>{nomb_modelo}</td>
								<td>{nomb_anio}</td>
								<td>{nomb_color}</td>
								<td>{nomb_placa}</td>
								<td>{nros_serie_unicos}</td>
							</tr>
							<tr>
								<th style="font-weight: normal;" colspan="2" scope="row">Aseguradora
									: {empresa}</th>
								<td>Póliza : {poliza_id}</td>
								<td colspan="2">Daño : Colisión</td>
								<td colspan="2">Estatus : Piso</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--end::Section-->
		<div class="row">
			<div class="col-sm-12">
				<div style="border-style: hidden;" class="card">
					<!--begin::Section-->
					<div style="font-size: 12px" class="kt-section">
						<div class="kt-section__content">
							<div class="table-responsive">
								<table style="text-align: center;margin:0 auto;width:80%; "
									class="table table-bordered">
									<thead>
										<tr style="background-color:rgb(240,240,240);">
											<th>Descripción</th>
											<th>Servicio</th>
											<th>Precio</th>
                      <th>Pintura</th>
                      <th>Refacciones</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th style="font-weight: normal;" scope="row">Luz trasera derecha</th>
											<td></td>
											<td></td>
                      <td></td>
                      <td></td>
										</tr>
                    <tr>
                      <th style="font-weight: normal;" scope="row">Llanta delantera izq.</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th style="font-weight: normal;" scope="row">Tapa Cajuela</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th style="font-weight: normal;" scope="row">Motor</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--end::Section-->
				</div>
			</div>
		</div>

		<!--begin::Section-->
		<div style="font-size: 12px" class="kt-section">
			<div class="kt-section__content">
				<div class="table-responsive">
					<table style="text-align: center;margin:5% auto;width:80%; "
						class="table table-bordered">
						<thead>
							<tr style="background-color:rgb(240,240,240);">
								<th style="font-weight: bold";>Sevicio</th>
								<th style="font-weight: bold">Pintura</th>
								<th style="font-weight: bold">Refacciones</th>
								<th style="font-weight: bold">Subtotal</th>
								<th style="font-weight: bold">IVA</th>
                <th style="font-weight: bold">TOTAL</th>
							</tr>

						</thead>
						<tbody>
							<tr>
								<th style="font-weight: normal;" scope="row"></th>
								<td style="font-weight: bold"></td>
								<td></td>
                <td></td>
                <td></td>
                <td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--end::Section-->
	</div>
</body>
</html>
