<?php
	/*
		Kitiara See
		Lab 14
		Date: 4/10/18
		Home page for Website that Creates and Manages bank accounts
	*/
	session_start();
?>
<!Doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Kitiara See">
  <title> PYGG Bank</title>
  <link rel="stylesheet" type="text/css" href="css/Bank.css">
</head>


<body>	
	<div id = "wrapper">
		<header>
			<h1>The PYGG Bank</h1>
			<h2> Holding Onto Money Since the 15th Century </h2>
		</header>	
		<nav>
			<table>
				<tr>
					<th><a href="index.php"> Home </a></th>
				</tr>
			</table>
		</nav>
		<section>
			<p>
				Welcome to The PYGG Bank online account management. <br>
				Press the Home Button above to try again.
			</p>
		</section>
	
		<?php
			session_destroy();
		?>
	</div>
</body>
</html>
