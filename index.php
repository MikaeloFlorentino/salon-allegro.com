<?php
$re=$_POST['g-recaptcha-response'];

	
$secret = "6Lf91tAUAAAAAKZmqGjjw9n2JDxvKx1cdS8Biav6";
 
if (isset($_POST['g-recaptcha-response'])) {
$captcha = $_POST['g-recaptcha-response']; 
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
'secret' => $secret,
'response' => $captcha,
'remoteip' => $_SERVER['REMOTE_ADDR']
);
 
$curlConfig = array(
CURLOPT_URL => $url,
CURLOPT_POST => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $data
);
 
$ch = curl_init();
curl_setopt_array($ch, $curlConfig);
$response = curl_exec($ch);
curl_close($ch);
}
 
$jsonResponse = json_decode($response);
 
$CUSTOM=$_POST['custId'];
if($CUSTOM!=""){
	if ($jsonResponse->success === true) {
	 
		$conn_string = "host=localhost port=5432 dbname=visitas user=postgres ";
     
		// establecemos una conexion con el servidor postgresSQL
		$dbconn = pg_connect($conn_string);
     
		// Revisamos el estado de la conexion en caso de errores. 
		if(!$dbconn) {
	    		echo "Error: No se ha podido conectar a la base de datos\n";
		} else {

			$nombre = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			$celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
			$email  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
			$mensaje = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

		    	$query = 'insert into public.mensajes (dominio, ip, nombre, celular, correo, mensaje) values';

			$query.= '(\'salon-allegro.com\', \''.$_SERVER['REMOTE_ADDR'].'\', ';
			$query.= '\''.$nombre.'\', \''.$celular.'\', ';
			$query.= '\''.$email.'\', \''.$mensaje.'\' )';
//	    	$query.= '\'.$_POST['name'].\', \'.$_POST['celular'].\', \'.$_POST['email'].\', \'.$_POST['message'].\' )';
//		echo "hola: " . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'). "_<br>";
//		echo "hola: " . $email. "_<br>";
	  //  	die( $query);
	     
		pg_query($dbconn, $query);
	     }
    	// 
		pg_close($dbconn);
	    
//	
	} else { 
		die("no");
	// Si el código no es válido, lanzamos mensaje de error al usuario 
	 
	}
}else{
	$conn_string = "host=localhost port=5432 dbname=visitas user=postgres ";
     
    // establecemos una conexion con el servidor postgresSQL
    $dbconn = pg_connect($conn_string);
     
    // Revisamos el estado de la conexion en caso de errores. 
    if(!$dbconn) {
    echo "Error: No se ha podido conectar a la base de datos\n";
    } else {
     $query='insert into visitas_dominio (pagina, ip, dominio) values (\'index.php\', \''.$_SERVER['REMOTE_ADDR'].'\',\'salon-allegro.com\')';

#    echo $query;
     pg_query($dbconn, $query);
    }
     
    // Close connection
    pg_close($dbconn);
}
/*
$CUSTOM=$_POST['custId'];
if($CUSTOM!=""){
#String a="6Lf91tAUAAAAAF1qWaRxRc8GYto0bsnDYwdIufYn";
#String b="6Lf91tAUAAAAAKZmqGjjw9n2JDxvKx1cdS8Biav6";
 
die("Revelando secretos");
	$titulo="Nueva Solicitud ".$CUSTOM;
	$NAME=$_POST['name'];
    $MAIL=$_POST['email'];
    $MESSAGE=$_POST['message'];
	$para  = 'contacto@quierosermason.com' . ', '; // atención a la coma
	$para .= $MAIL;
   $cuerpo='
    Hola contacto<br>
    <br>
    Se a recibido una nueva solicitu de informes, el interesado es: <b>'.$NAME.'</b> quien tiene un<br>
    correo: <i>'.$MAIL.'</i><br>
    <br>
    -------<br>'.
    $MESSAGE;

    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $cabeceras .= 'To: '.$NAME.' <'.$MAIL.'>, Contacto <contacto@quierosermason.com>' . "\r\n";
    $cabeceras .= 'Reply-To: contacto@quierosermason.com' . "\r\n";
    $cabeceras .= 'From: Contacto <contacto@quierosermason.com>' . "\r\n";

#    mail($para, $titulo, $cuerpo, $cabeceras, "contacto@quierosermason.com");
#    die($CUSTOM.'<br>'.$para.'<br>'.$título.'<br>'.$cuerpo.'<br>'.$cabeceras);

#	die("Si");
}else{
    $conn_string = "host=localhost port=5432 dbname=visitas user=postgres ";
     
    // establecemos una conexion con el servidor postgresSQL
    $dbconn = pg_connect($conn_string);
     
    // Revisamos el estado de la conexion en caso de errores. 
    if(!$dbconn) {
    echo "Error: No se ha podido conectar a la base de datos\n";
    } else {
     $query='insert into visitas_dominio (pagina, ip, dominio) values (\'index.php\', \''.$_SERVER['REMOTE_ADDR'].'\',\'salon-allegro.com\')';

#    echo $query;
     pg_query($dbconn, $query);
    }
     
    // Close connection
    pg_close($dbconn);

}*/
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
</script>

	</head>
	<body class="is-preload">

		<!-- Header -->
			<section id="header">
				<header>
					<font color="#ffffff" background-color="#ffffff">
						<h1>Salon Allegro</h1>
						<p>Tu lugar con sabor a hogar</p>
					</font>
				</header>
				<footer>
					<a href="#banner" class="button style2 scrolly-middle">Conoce mas</a>
				</footer>
			</section>

		<!-- Banner -->
			<section id="banner">
				<header>
					<h2>Esto es Salon Allegro</h2>
				</header>
				<p>En salon allegro nos gusta ser complices de esas historias, <br />
					de ser participe en el festejo, en saberte en familia y <br />
					compartir el logro, el cumpleaños, los XV años, la boda, <br />
					el aniversario, todo, absolutamente todo queremos compartir <br />
					contigo y con tu familia
				</p>
				<footer>
					<a href="#first" class="button style2 scrolly">Conoce mas</a>
				</footer>
			</section>

		<!-- Feature 1 -->
			<article id="first" class="container box style1 right">
                <a class="image fit">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7389.498741401446!2d-100.96561566360798!3d22.17361035835081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842aa1eb091e05bd%3A0x1740b30797910fd!2sAllegro!5e0!3m2!1ses!2smx!4v1579546924370!5m2!1ses!2smx" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
<!--    				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1847.370233058969!2d-100.96096003657841!3d22.17394917253383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842aa1eb091e05bd%3A0x1740b30797910fd!2sAllegro!5e0!3m2!1ses!2smx!4v1579467513561!5m2!1ses!2smx" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                </a>
				<div class="inner">
					<header>
						<h2>Estamos<br />
						cerca de ti</h2>
					</header>
					<p>Nos pueden encontrar en: Av Soledad #100, Fraccionamiento Valle de Santiago, Soledad de Graciano Sanchez, San Luis Potosí</p>
				</div>
			</article>

		<!-- Feature 2 -->
			<article class="container box style1 left">
				<a href="#" class="image fit"><img src="images/allegro.jpg" alt="" /></a>
				<div class="inner">
					<header>
						<h2>Cabemos<br />
						Todos</h2>
					</header>
					<p>Con capacidad para 100 personas, para que puedan venir toda la familia</p>
				</div>
			</article>

			<article class="container box style2">
				<header>
					<h2>Hemos sido testigos de <br />Magnos Eventos</h2>
					<p>Para esas ocaciones especiales<br />
					para festejar ese bello momento.</p>
				</header>
				<div class="inner gallery">
					<div class="row gtr-0">
						<div class="col-3 col-12-mobile"><a href="images/fulls/01.jpg" class="image fit"><img src="images/thumbs/01.jpg" alt="" title="Sean bienvenidos" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/02.jpg" class="image fit"><img src="images/thumbs/02.jpg" alt="" title="a Salon Allegro" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/03.jpg" class="image fit"><img src="images/thumbs/03.jpg" alt="" title="Baby Showers" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/04.jpg" class="image fit"><img src="images/thumbs/04.jpg" alt="" title="Bautizos" /></a></div>
					</div>
					<div class="row gtr-0">
						<div class="col-3 col-12-mobile"><a href="images/fulls/05.jpg" class="image fit" width="531" heigt="1032px"><img src="images/thumbs/05.jpg" alt="" title="Primera Comunion" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/06.jpg" class="image fit"><img src="images/thumbs/06.jpg" alt="" title="Graduaciones" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/07.jpg" class="image fit"><img src="images/thumbs/07.jpg" alt="" title="Estamos para todos" /></a></div>
						<div class="col-3 col-12-mobile"><a href="images/fulls/08.jpg" class="image fit"><img src="images/thumbs/08.jpg" alt="" title="Y hasta Bodas" /></a></div>
					</div>
				</div>
			</article>

		<!-- Contact -->
			<article class="container box style3">
				<header>
					<h2>Mandanos un mensaje</h2>
					<p>Contactanos ó mandanos un correo a:<br><b>hola@salon-allegro.com</b></p>
				</header>
				<form method="post" action="#">
					<div class="row gtr-50">
						<div class="col-6 col-12-mobile"><input type="text" class="text" name="name" placeholder="Nombre" /></div>
						<div class="col-6 col-12-mobile"><input type="text" class="text" name="celular" placeholder="celular" /></div>
						<div class="col-12">
							<input type="text" class="text" name="email" placeholder="Correo" /></div>
						<div class="col-12">
							<textarea name="message" placeholder="Mensaje"></textarea>
						</div>
						 <input type="hidden" id="custId" name="custId" value="12">
                        <center><div class="g-recaptcha" data-sitekey="6Lf91tAUAAAAAF1qWaRxRc8GYto0bsnDYwdIufYn"></div></center>
						<div class="col-12">
							<ul class="actions">
								<li><input type="submit" value="Enviar" /></li>
							</ul>
						</div>
					</div>
				</form>
			</article>

		<!-- Generic -->
		<!--
			<article class="container box style3">
				<header>
					<h2>Generic Box</h2>
					<p>Just a generic box. Nothing to see here.</p>
				</header>
				<section>
					<header>
						<h3>Paragraph</h3>
						<p>This is a subtitle</p>
					</header>
					<p>Phasellus nisl nisl, varius id <sup>porttitor sed pellentesque</sup> ac orci. Pellentesque
					habitant <strong>strong</strong> tristique <b>bold</b> et netus <i>italic</i> malesuada <em>emphasized</em> ac turpis egestas. Morbi
					leo suscipit ut. Praesent <sub>id turpis vitae</sub> turpis pretium ultricies. Vestibulum sit
					amet risus elit.</p>
				</section>
				<section>
					<header>
						<h3>Blockquote</h3>
					</header>
					<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget.
					tempus euismod. Vestibulum ante ipsum primis in faucibus.</blockquote>
				</section>
				<section>
					<header>
						<h3>Divider</h3>
					</header>
					<p>Donec consectetur <a href="#">vestibulum dolor et pulvinar</a>. Etiam vel felis enim, at viverra
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
					posuere cubilia.</p>
					<hr />
					<p>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra
					ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel. Praesent nec orci
					facilisis leo magna. Cras sit amet urna eros, id egestas urna. Quisque aliquam
					tempus euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
					posuere cubilia.</p>
				</section>
				<section>
					<header>
						<h3>Unordered List</h3>
					</header>
					<ul>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ul>
				</section>
				<section>
					<header>
						<h3>Ordered List</h3>
					</header>
					<ol>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
						<li>Donec consectetur vestibulum dolor et pulvinar. Etiam vel felis enim, at viverra ligula. Ut porttitor sagittis lorem, quis eleifend nisi ornare vel.</li>
					</ol>
				</section>
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
									<th>Description</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
								<tr>
									<td>45815</td>
									<td>Something</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>24524</td>
									<td>Nothing</td>
									<td>Ut porttitor sagittis lorem quis nisi ornare.</td>
									<td>19.99</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3"></td>
									<td>100.00</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</section>
				<section>
					<header>
						<h3>Form</h3>
					</header>
					<form method="post" action="#">
						<div class="row">
							<div class="col-6 col-12-mobile">
								<input class="text" type="text" name="name" id="name" value="" placeholder="John Doe" />
							</div>
							<div class="col-6 col-12-mobile">
								<input class="text" type="text" name="email" id="email" value="" placeholder="johndoe@domain.tld" />
							</div>
							<div class="col-12">
								<select name="department" id="department">
									<option value="">Choose a department</option>
									<option value="1">Manufacturing</option>
									<option value="2">Administration</option>
									<option value="3">Support</option>
								</select>
							</div>
							<div class="col-12">
								<input class="text" type="text" name="subject" id="subject" value="" placeholder="Enter your subject" />
							</div>
							<div class="col-12">
								<textarea name="message" id="message" placeholder="Enter your message"></textarea>
							</div>

							<div class="col-12">
								<ul class="actions">
									<li><input type="submit" value="Submit" /></li>
									<li><input type="reset" class="style3" value="Clear Form" /></li>
								</ul>
							</div>
						</div>
					</form>
				</section>
			</article>
		-->

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
