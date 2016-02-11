<?php
 
use SamHenry\Sorter\Sorter;
 
class SorterTest extends PHPUnit_Framework_TestCase {
 
  public function testSortMixedArray()
  {
    $sorter = new Sorter();
	
	//Test 1st example
	$input = '{ "10", "2", "washington", "1", "test", "11" }';
	$expected = '{"1","2","test","10","washington","11"}';
	$result = $sorter->sortMixedArray($input);
    $this->assertEquals($result,$expected);
	
	//Test 2nd example
	$input = '{ "6","testing","abc","5","1","beta","2321432","zeta","dog" }';
	$expected = '{"1","abc","beta","5","6","dog","2321432","testing","zeta"}';
	$result = $sorter->sortMixedArray($input);
    $this->assertEquals($result,$expected);
  }
 
}