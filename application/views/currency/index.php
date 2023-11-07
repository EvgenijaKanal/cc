<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>How to create currency converter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->

	<!-- Optional theme -->
	<!--<<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> -->

</head>

<body>

<!-- <div class="container  d-flex justify-content-center">
	<div class='col-md-5'>
		<div class="form-group">
			<div class='input-group date' id='datetimepicker7'>
				<input type='text' class="form-control" />
				<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
			</div>
		</div>
	</div>
</div>-->
<div class="currency-row-outer">
	<div class="currency-converter">
		<h2>Currency Converter</h2>

		<div class="field grid-50-50">
			<div class="colmun col-left">
				<input type="number" class="form-input" id="number" placeholder="00000">
			</div>
			<div class="colmun col-right">
				<div class="select">
					<select name="currency" class="currency" onchange="updatevalue()"></select>
				</div>
			</div>
		</div>

		<div class="field grid-50-50">
			<div class="colmun col-left">
				<input type="text" class="form-input" id="output" placeholder="00000" disabled>
			</div>
			<div class="colmun col-right">
				<div class="select">
					<select name="currency" class="currency" onchange="updatevalue()"></select>
				</div>
			</div>
		</div>

	</div>
</div>
<script src="js/ajax.js"></script>
</body>

</html>
