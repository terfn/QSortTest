#!/usr/bin/php
<?php
  function quicksort(& $a, $left, $right) {
	  if ($left < $right) {
		  $pivotIdx = $left + (($right - $left) / 2);
		  $newPivotIdx = partition($a, $left, $right, $pivotIdx);
		  quicksort($a, $left, $newPivotIdx - 1);
		  quicksort($a, $newPivotIdx + 1, $right);
	}
  }

  function partition(& $a, $left, $right, $pivotIdx) {
	  $pivotVal = $a[$pivotIdx];
	  swap($a, $pivotIdx, $right);
	  $storeIdx = $left;
	  for($i = $left; $i < $right; $i++)
		  if($a[$i] < $pivotVal) {
			  swap($a, $i, $storeIdx);
			  $storeIdx++;
		  }
	  swap($a, $storeIdx, $right);
	  return $storeIdx;
  }

  function swap(& $a, $x, $y) {
	  $tmp = $a[$x];
	  $a[$x] = $a[$y];
	  $a[$y] = $tmp;
  }

  function initArray(& $a, $filename, $size) {
	  $iF = fopen($filename, "r"); $i = 0;
	  while($i < $size)
	    $a[$i++] = (int)fgets($iF);
	  fclose($iF);
  }

  function printArray(& $a, $filename) {
	  $oF = fopen($filename, "w");
	  for($i = 0; $i < count($a) - 1; $i++)
	    fputs($oF, $a[$i]."\n");
	  fclose($oF);
  }

  function powTen($idx) {
	if($idx == 0)
		return 1;
	 else
		 return 10 * powTen($idx - 1);
  }

  function main($argc, $argv) {
	  if((($argc < 2) || ($argc > 3))) {
		echo "Usage Qsort.php <power of 10>".PHP_EOL;
		return;
	  }

      $IDX = (int)$argv[1];
	  $ARRAY_SIZE = powTen($IDX);
	  $a = new SplFixedArray($ARRAY_SIZE);
	  $ifName = "10e".$IDX.".txt";
	  $ofName = "10e".$IDX."sortedPHP.txt";
	  initArray($a, $ifName, $ARRAY_SIZE);
	  quicksort($a, 0, $ARRAY_SIZE - 1);
	  //Used to test sorting
      if(($argc == 3) && ($argv[2] == "--print"))
	     printArray($a, $ofName, $ARRAY_SIZE);
	  unset($a);
	  echo "Sorted ".$ARRAY_SIZE." ints in php".PHP_EOL;
  }
  
  ini_set('memory_limit','8G');
  main($argc, $argv);
?>
