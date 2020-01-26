<?php
		$conn_string = "host=localhost port=5432 dbname=visitas user=postgres ";
     
		// establecemos una conexion con el servidor postgresSQL
		$dbconn = pg_connect($conn_string);
     
		// Revisamos el estado de la conexion en caso de errores. 
		if(!$dbconn) {
	    		echo "Error: No se ha podido conectar a la base de datos\n";
		} else {

			$query = 'SELECT id_mensajes,  (fecha - interval \'6 hour\') as dia, nombre, ';
			$query.= 'celular, correo, mensaje, leido FROM public.mensajes ';
			$query.= 'order by fecha desc';
                        $result = pg_query( $query);

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
		
			<article class="container box style3">
				<section>
					<header>
						<h3>Table</h3>
					</header>
					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>fecha</th>
									<th>Leido</th>
								</tr>
							</thead>
							<tbody>
							<?php
								while ($row = pg_fetch_row($result)) {
									echo "<tr>";
    echo "<td><a href='mensaje.php?id=".$row[0]."' target='tuArchivo' onclick=\"window.open(this.href, this.target, ' width=1000, height=400, menubar=no');return false;\">". $row[0]."</a> </td>";
									echo "<td>" . htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8'). "</td>";
									echo "<td>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8'). "</td>";
									echo "<td>" . htmlspecialchars($row[6], ENT_QUOTES, 'UTF-8'). "</td>";
									echo "</tr>";
								}
							?>

								
								
							</tbody>
						</table>
					</div>
                </section>
			</article>

		<section id="footer">
			<ul class="icons">
				<!-- <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li> -->
				<li><a href="https://www.facebook.com/pg/Salon-Allegro-373342889752879" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
				<!-- <li><a href="#" class="icon brands fa-google-plus-g"><span class="label">Google+</span></a></li>
				<li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
				<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
				<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li> -->
			</ul>
			<div class="copyright">
				<ul class="menu">
					<li>:D.</li><li>Design: HTML5 UP</li>
				</ul>
			</div>
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
