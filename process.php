<?php 

require_once("advanced1.php");
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'draw')
{
	$_SESSION['p1']->draw($_SESSION['deck']);
	$_SESSION['p1_sum'] = 0;
	foreach($_SESSION['p1']->hand as $card){
		$helper = new Helper();
		$_SESSION['p1_sum'] += $helper->cardValue($card);
	}
	if ($_SESSION['p1_sum'] > 21)
	{
		$_SESSION['message'] = "Player busted.<br>";
	}
	if ($_SESSION['p1_sum'] == 21)
	{
		$_SESSION['message'] = "Player won!<br>";
	}
	header("location:index.php");
}

if (isset($_POST['action']) && $_POST['action'] == 'stay')
{
	while($_SESSION['p2_sum']<17){
		$_SESSION['p2']->draw($_SESSION['deck']);
		$p2_sum = 0;
		foreach($_SESSION['p2']->hand as $card){
			$helper = new Helper();
			$p2_sum += $helper->cardValue($card);
			$_SESSION['p2_sum'] = $p2_sum;
		}
	}
	if($_SESSION['p2_sum']>21){
		$_SESSION['message'] = "Dealer busted.<br>";
	}
	else if($_SESSION['p1_sum'] == $_SESSION['p2_sum']){
		$_SESSION['message'] = "Push!<br>";
	}
	else
	{
		if($_SESSION['p2_sum']>$_SESSION['p1_sum']){
			$_SESSION['message'] = "You lost!<br>";
		}
		else{
			$_SESSION['message'] = "You won!<br>";
		}
	}
	header("location:index.php");
}

if (isset($_POST['action']) && $_POST['action'] == 'start')
{
	$_SESSION['start'] = true;
	$_SESSION['message'] = null;
	$deck = new Deck();
	$p1 = new Player();
	for($i=0; $i<2; $i++){
		$p1->draw($deck);
	}
	$p2 = new Player();
	$p2->draw($deck);
	$_SESSION['deck'] = $deck;
	$_SESSION['p1'] = $p1;
	$_SESSION['p2'] = $p2;
	$_SESSION['p1_sum'] = 0;
	$_SESSION['p2_sum'] = 0;
	header("location:index.php");
}
?>