<?php
		$conn_string = "host=localhost port=5432 dbname=visitas user=postgres ";
     
		// establecemos una conexion con el servidor postgresSQL
		$dbconn = pg_connect($conn_string);
     
		// Revisamos el estado de la conexion en caso de errores. 
		if(!$dbconn) {
	    		echo "Error: No se ha podido conectar a la base de datos\n";
		} else {

			$query = 'SELECT (fecha - interval \'6 hour\') as dia, nombre, ';
			$query.= 'celular, correo, mensaje FROM public.mensajes ';
			$query.= 'where id_mensajes='.$_GET['id'];
            $result = pg_query( $query );
            $row = pg_fetch_row($result);
		}
    	// 
		pg_close($dbconn);
	    

?>
<html>
	<head>
		<title>Salon Allegro</title>
        <meta name="description" content="Pagina Oficial del Salon Allegro, para tus eventos en San Luis Potosi, ubicados por acceso norte">
        <!-- Meta Keyword -->
        <meta name="keywords" content="salon allegro, san luis potosi, mexico, salon de eventos, salon de fiestas, soledad de graciano sanches, mexico, pura fiesta">
      
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js?" async defer></script>

	</head>
	<body class="is-preload">


		<!-- Generic -->
		<section id="header">
			<article class="container box style3">
				<section>
					<div class="table-wrapper">
						<table>
							<tbody>
								<tr>
									<th>nombre</th>
									<td>
									<?php
										echo htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8');
									?>
									</td>
									<th>fecha</th>
									<td>
									<?php
										echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8');
									?>
									</td>
								</tr>
								
								<tr>
									<th>correo</th>
									<td>
									<?php
										echo htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8');
									?>
									</td>
									<th>celular</th>
									<td>
									<?php
										echo htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8');
									?>
									</td>
								</tr>
								
								
								<tr>
									<th colspan="4">mensaje</th>
								</tr>

								<tr>
									<td colspan="4">
									<?php
										echo htmlspecialchars($row[4], ENT_QUOTES, 'UTF-8');
									?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                </section>
			</article>

		</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
