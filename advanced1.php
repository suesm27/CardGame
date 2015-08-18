<?php
class Deck{
	public $cards;
	public function __construct(){
		$this->cards = array();
		$this->cards = range(0,51);
	}
	public function Shuffle(){
		shuffle($this->cards);
		return $this;
	}
	public function Reset(){
		$this->cards = range(0,51);
	}
	public function deal(){
		$index = rand(0,sizeof($this->cards)-1);
		$card = $this->cards[$index];
		$helper = new Helper();
		$newDeck = $helper->moveCardToLast($this->cards, $index);
		$this->cards = $newDeck;
		return array_pop($this->cards);
	}
}

class Player{
	public $name;
	public $hand = array();
	public function draw($deck){
		$cardDrawn = $deck->deal();
		array_push($this->hand, $cardDrawn);
		return $cardDrawn;
	}
	public function discard($index){
		$card = $this->hand[$index];
		$helper = new Helper();
		$newHand = $helper->moveCardToLast($this->hand, $index);
		$this->hand = $newHand;
		return array_pop($this->hand);
	}
}

class Helper{
	public function moveCardToLast($array, $index){
		$a = $array[$index];
  		for($i=$index; $i<sizeof($array)-1; $i++){
    		$array[$i] = $array[$i+1];
  		}
  		$array[sizeof($array)-1] = $a;
  		return $array;
	}
	public function cardValue($n){
		$cardValue = array(1,2,3,4,5,6,7,8,9,10,10,10,10,
							1,2,3,4,5,6,7,8,9,10,10,10,10,
							1,2,3,4,5,6,7,8,9,10,10,10,10,
							1,2,3,4,5,6,7,8,9,10,10,10,10);
		return $cardValue[$n];
	}
}
?>