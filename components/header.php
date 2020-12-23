<?php
session_start();
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<?php
	if (isset($_COOKIE['darkmode'])) {?>
		<style>
			body {
				color: white;
				background-color: black;
			}

			.card {
				color: white;
				background-color: #212529;
			}

			.btn-outline-dark {
				background-color: white;
			}

			.btn-outline-primary {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}

			.btn-outline-primary:hover {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-outline-success {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}

			.btn-outline-success:hover {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-outline-danger {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}

			.btn-outline-danger:hover {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-danger {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-danger:hover {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}

			.btn-success {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-success:hover {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}

			.btn-primary {
				background-color: white;
				color: black;
				border-color: white;
			}

			.btn-primary:hover {
				background-color: #212529;
				color: white;
				border-color: #212529;
			}
		</style>
	<?php } ?>
</head>