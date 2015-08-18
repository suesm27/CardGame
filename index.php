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
	.container {
		max-width: 800px;
		background-color: green;
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
	}
	?>
	<div class="container">
		<div class = "row">
			<form role="form" action="process.php" method="post">
				<input type="hidden" name="action" value="start">
				<button class="btn-primary btn-lg" type="submit">Start Game</button>
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
						echo "<IMG SRC='" . $card . ".png'><br>";
						if ($_SESSION['p1_sum'] > 21)
						{
							$_SESSION['message'] = "Player busted.<br>";
						}
					}
					echo "Player's hand: {$_SESSION['p1_sum']}";
					?>
					<form role="form" action="process.php" method="post">
						<input type="hidden" name="action" value="draw">
						<button class="btn-primary" type="submit">Draw</button>
					</form>
					<form role="form" action="process.php" method="post">
						<input type="hidden" name="action" value="stay">
						<button class="btn-primary" type="submit">Stay</button>
					</form>
				</div>
				<div class="col-md-6">
					<?php			
					echo "<br>Dealer: <br>";
					$_SESSION['p2_sum'] = 0;
					foreach($_SESSION['p2']->hand as $card){
						$helper = new Helper();
						$_SESSION['p2_sum'] += $helper->cardValue($card);
						echo "<IMG SRC='" . $card . ".png'><br>";
					}
					echo "Dealer's hand: {$_SESSION['p2_sum']}";
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>