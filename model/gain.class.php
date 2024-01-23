<?php

class Gain{


    private array $sum = [
        "1" => 100,
        "2" => 75,
        "3" => 50,
        "4" => 35,
    ];

    private function getGainRank(array $array): int {
		$res=0;
		foreach($array as $gain){
				$res +=$gain;
        }
        return (count($array) > 0) ? $res /count($array) : 0;
		}







    };


?>