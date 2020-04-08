<?php
// Create Input Array
$array = [];
for ($i=0; $i < 50000; $i++) { 
    array_push($array, random_int(0, 999));
}

function mergeSort($input) {
    // Calculate input array length
    $input_length = count($input);

    // Base case of recursion: return input if input length is 1
    if ($input_length === 1) {
        return $input;
    }

    // Slice the input array in 2 parts
    $counter = floor($input_length / 2);
    $slice_1 = mergeSort(array_slice($input, 0, $counter));
    $slice_2 = mergeSort(array_slice($input, $counter, $input_length - $counter));

    // Merge the 2 parts
    return merge($slice_1, $slice_2);
}

function merge($slice_1, $slice_2) {
    $pointer_1 = 0; // Keeps track of $slice_1 traversing
    $pointer_2 = 0; // Keeps track of $slice_2 traversing
    $slice_1_length = count($slice_1);
    $slice_2_length = count($slice_2);
    $output_length = $slice_1_length + $slice_2_length;
    $output = [];

    // Iterate with a for loop and pointers in order to get rid of array_shift()
    // Increases performances by a factor of ~ 30
    for ($k=0; $k < $output_length; $k++) {
        // Check if both slices contain elements that still have to be compared
        if (count($slice_1) > $pointer_1 && count($slice_2) > $pointer_2) {
            if ($slice_1[$pointer_1] < $slice_2[$pointer_2]) {
                array_push($output, $slice_1[$pointer_1]);
                $pointer_1++;
            } elseif ($slice_1[$pointer_1] >= $slice_2[$pointer_2]) {
                array_push($output, $slice_2[$pointer_2]);
                $pointer_2++;
            }
        } else {
            // No logic required, since only 1 of the 2 slices still contains elements
            if (count($slice_1) === $pointer_1) {
                array_push($output, $slice_2[$pointer_2]);
                $pointer_2++;
            } elseif (count($slice_2) === $pointer_2) {
                array_push($output, $slice_1[$pointer_1]);
                $pointer_1++;
            } else {
                break;
            }
        }
    }

    return $output;
}

// A little benchmarking
$start = microtime(true);

// mergeSort custom function
mergeSort($array);
$end_mergeSort = microtime(true);
echo "mergeSort() execution time: " . ($end_mergeSort - $start) . "\n";

// PHP native sort function (underlying C implementation is based on quicksort)
sort($array);
$end_sort = microtime(true);
echo "sort() execution time: " . ($end_sort - $end_mergeSort);

// Custom mergeSort is still slower than native sort by a factor of 10

exit();