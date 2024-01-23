<?php

class Gain{


    private array $sum = [
        "1" => 100,
        "2" => 75,
        "3" => 50,
        "4" => 35,
    ];

    public function getGainRank(array $array): int {
		$res=0;
		foreach($array as $gain){
				$res +=$this->sum[$gain]; //res
        }
        return (count($array) > 0) ? $res /count($array) : 0;
		}







    };


?>