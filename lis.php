<?php

/**
 * User input examples:
 * 1
 * 7  3 5 8 -1 0 6 7
 * 1 2 5  3 5 2 4 1
 * 0 10 20 30 30 40  1 50 2 3 4 5 6
 * 11 12 13  3 14 4 15 5 6 7 8 7 16 9 8 -> 3 4 5 6 7 8 16
 * 3 14  5 12 15 7 8 9 11 10 1 -> 3 5 7 8 9 11
 */
$userInput = readline('Enter numbers: ');
$nums = array_filter(explode(' ', $userInput));

if (count($nums) !== count(array_filter($nums, 'is_numeric' ) ) ) {
	echo 'All the elements must be integers.' . PHP_EOL;
	return;
}

$lis = constructLis($nums);
printLis($lis, $nums);

/**
 * @param array $nums
 * @return array
 */
function constructLis(array $nums): array
{
	$sequence = [];
	$maxIndex = 0;

	for ($i = 0; $i < count($nums); $i++) {

		$index[$i] = 1;
		$sequence[$i] = [];

		for ($j = 0; $j < $i; $j++) {
			if ($nums[$j] < $nums[$i] && $index[$j] > $index[$i] - 1) {
				$index[$i] = $index[$j] + 1;

				$sequence[$i][] = $j;

				if ($index[$i] > $index[$maxIndex]) {
					$maxIndex = $i;
				}
			}
		}

		if ($index[$i] > $maxIndex) {
			$maxIndex = $index[$i];
		}
	}

	$lis = max($sequence);
	array_push($lis, $maxIndex);

	return $lis;
}

/**
 * @param array $lis
 * @param array $nums
 */
function printLis(array $lis, array $nums): void
{
	foreach ($lis as $key => $v) {
		echo $nums[$v] . PHP_EOL;
	}
}






