<?php 

require_once('advanced1.php');
session_start();

// var_dump($p1->hand);
// $deck->Reset();
// var_dump($deck);
// var_dump($p1->hand);
// $p1->discard(2);
// var_dump($p1->hand);
// var_dump($deck);
// $deck->Shuffle();
// var_dump($deck);

?>

<html>
<head>
	<meta name="description" content="a full deck of playing card icons">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="keywords" content="playing cards, deck of cards, deck, cards, icons, images">
	<title>playing cards</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- latest compiled and minified css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- latest compiled and minified javascript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<style>
	.felt {
		max-width: 800px;
		/*max-height: 500px;*/
		background-image: url("background.jpg");
		margin: 18px auto;
		padding: 15px;
		border-radius: 15px;
	}
	.wood {
		background-image: url("wood.jpg");
		background-repeat: no-repeat;
		background-size: 840px 840px;
		max-width: 840px;
		/*max-height: 540px;*/
		border-radius: 15px;
		margin: 10px auto;
	}
	.btn-lg {
		margin: 10px;
	}
	.btn-info {
		display: block;
		vertical-align: middle;
		margin: 0 auto;
	}
	body {
		color: white;
		text-align: center;
		margin: 0 auto;
	}
	.draw_stay {
		display: inline-block;
	}
	img {
		display: inline-block;
	}
	</style>
</head>
<body>
	<?php
	if(isset($_SESSION['start']) && $_SESSION['message'] != null){
		echo "<div class='alert alert-info'>";
		echo "<strong>";
		echo $_SESSION['message']; 
		$_SESSION['message'] = null;
		echo "</strong>";
		echo "</div>";
		session_destroy();
	}
	?>
	<div class="container wood">
	<div class="container felt">
		<div class = "row">
			<form role="form" action="process.php" method="post">
				<input type="hidden" name="action" value="start">
				<button class="btn-primary btn-lg" type="submit">Start Game</button>
			</form>
			<form class="draw_stay" role="form" action="process.php" method="post">
				<input type="hidden" name="action" value="draw">
				<button class="btn-info" type="submit">Draw</button>
			</form>
			<form class="draw_stay" role="form" action="process.php" method="post">
				<input type="hidden" name="action" value="stay">
				<button class="btn-info" type="submit">Stay</button>
			</form>
		</div>
		<div class = "row">
			<div class="col-md-6">
				<?php
				if (isset($_SESSION['start']) && $_SESSION['start'])
				{
					echo "Player: <br>";
					$_SESSION['p1_sum'] = 0;
					foreach($_SESSION['p1']->hand as $card){
						$helper = new Helper();
						$_SESSION['p1_sum'] += $helper->cardValue($card);
						echo "<IMG SRC='" . $card . ".png'>";
					}
					echo "<br>Player's hand: {$_SESSION['p1_sum']}";
					?>
				</div>
				<div class="col-md-6">
					<?php			
					echo "<br>Dealer: <br>";
					$_SESSION['p2_sum'] = 0;
					foreach($_SESSION['p2']->hand as $card){
						$helper = new Helper();
						$_SESSION['p2_sum'] += $helper->cardValue($card);
						echo "<img src='" . $card . ".png'>";
					}
					echo "<br>Dealer's hand: {$_SESSION['p2_sum']}";
				}
				?>
			</div>
		</div>
	</div>
	</div>
</body>
</html>