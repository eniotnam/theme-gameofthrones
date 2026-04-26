<?php
require_once 'models/query.php';
$query = new query;

$houses = $query->select('*', 'house');

?>

<head>

	<link rel="stylesheet" href="css/style.css">
	<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"
	        integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9"
	        crossorigin="anonymous"></script>


</head>


<div class="container">
	<div class="row justify-content-center" id="logo" >
		<div class="col-lg-5 col-12 p-lg-5">
			<img width="100%" src="img/rings.png" alt="">
		</div>
	</div>
	<div class="row justify-content-center allList">
		<div class="col-12 p-0 d-flex justify-content-center flex-wrap align-center align-items-center" id="houseLogo">

            <?php foreach ($houses as $house) {
                ?>
				<a href="house.php?id=<?php echo $house['id'] ?>"
				   class="col-md-4  my-2 my-lg-3 d-flex flex-wrap justify-lg-content-center align-items-center house">
					<div class="col-lg-12 col-6 symbol p-0">
						<img src="img/symbol/<?php echo strtolower($house['nom']); ?>.png" alt="">
					</div>
					<div class="col-lg-12 col name ">
						<h3><?php echo $house['nom'] ?></h3>
					</div>
				</a>

            <?php } ?>

		</div>
	</div>
</div>

<script src="js/functions.js"></script>

