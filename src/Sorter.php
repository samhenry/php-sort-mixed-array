<?php

namespace SamHenry\Sorter;

class Sorter {
	
	/*
	* Sort the input such that numberic values are in numeric order, 
	* and the alphanumeric values are in alphabetical order
	* $input (string)
	* return (string)
	*/
    public static function sortMixedArray($input) {
		
		//echo 'Input: '.$input;
		
		//Find all of the values in quotes in the input string
		preg_match_all('/"([^"]*)"/',$input,$matches);
		$values = $matches[1];
		unset($matches[1]);
		
		$i = 0;
		$size = count($values);
		$alphas = array();
		$numerics = array();
		$types = array();
		
		//Iterate over the input values
		for($i; $i < $size; ++$i){
			
			//If the value is numeric, add to numeric values array
			//	else, add to alphanumeric value array
			//	Also, build separate array indicating type at each position
			if(is_numeric($values[$i])){
				$numerics[] = $values[$i];
				$types[] = true;
			} else {
				$alphas[] = $values[$i];
				$types[] = false;
			}
		}
		unset($values);
		
		//Sort each collection of values appropriately
		sort($numerics,SORT_NUMERIC);
		sort($alphas,SORT_STRING);
		
		//echo '<br>Numerics<pre>'; print_r($numerics);echo '</pre>';
		//echo '<br>Alphas<pre>'; print_r($alphas);echo '</pre>';
		
		$i = 0;
		$alphaCount = $numericCount = 0;
		$result = array();
		
		//Iterate over each input value position
		for($i = 0; $i < $size; ++$i) {
			
			//If the type for this position was numeric,
			//	use the next value from the numeric array,
			//	vice-versa for non-numeric positions
			if ($types[$i]) {
				$result[$i] = $numerics[$numericCount];
				++$numericCount;
			} else {
				$result[$i] = $alphas[$alphaCount];
				++$alphaCount;
			}
		}
		
		//echo '<br>Result<pre>'; print_r($result);echo '</pre>';
		
		//Format response with values in quotes surrounded by curly braces
        return "{\"".implode($result,'","')."\"}";
    }
}

//Testing
//echo Sorter::sortMixedArray('{ "10", "2", "washington", "1", "test", "11" }'); echo '<br>';
//echo Sorter::sortMixedArray('{ "6","testing","abc","5","1","beta","2321432","zeta","dog" }'); echo '<br>';