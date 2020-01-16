<?php
//INSTRUCTIONS_____________________________________________
//add text file to talkative-technical-test-word-count-Jan-2019 directory
//call results('test file')
//see below for examples with bible.txt and text1.txt
//open talkative-technical-test-word-count-Jan-2019/word-counter.php in your local host and watch the magic happen.

//notes_____________________________________________
//This program counts punctuation within words such as apostrophes or exclamation marks as letters and because of this I have also left any apostrophes at the end of words such as "James'"

//If a word ends in more than one punctuation (eg. YES!!!) only the last one will be removed which will give an incorrect count. This is not the cause for the next problem.

//Whilst I have done my best to remove any extra spaces in the texts when I run bible.txt it shows that there is still a word with 0 letters. Seeing as I managed to remove the other 1930 I would have liked to have figured out what caused this but I have run out of time (and I don't have a clue).

//results('bible.txt');
results('text1.txt');

/**
 * @param string $resource is a resource not a string
 */
function results(string $resource)
{
    $text = readTxt($resource);

    $textArr = stringToArrayConvert($text);
    unset($text);

    $wordCount = wordCount($textArr);
    echo 'Word count = ' .$wordCount . '<br>';

    echo 'Average word length ' . wordLengthAverage($textArr, $wordCount) . '<br>';

    $wordLengthArr = wordLengthArr($textArr);
    unset($textArr);

    foreach ($wordLengthArr as $key => $count) {
        echo 'Number of words of length ' . $key . ' is ' . $count . '<br>';
    }
    wordLengthFrequency($wordLengthArr);
}
/**
 * reads the text in the resource
 * @param string $resource is a resource not a string
 * @return bool|string returns false if unable to read otherwise returns the text of the resource given.
 */
function readTxt(string $resource)
{
    $openText = fopen($resource, 'r');
    $text = fread($openText, filesize($resource));
    fclose($openText);
    return $text;
}
/**
 * takes the text from the resource gets rid of unnecessary punctuation and any words with 0 letters
 * @param string $text the body of the user inputted resource
 * @return array array of words
 */
function stringToArrayConvert(string $text)
{
    $i = 0;
    $textArr = explode(" ", $text);

    foreach ($textArr as $key => $word) {
        if (preg_match("/[.+,+?+!+:+;+]$/", $word)) {
             $textArr[$key] = substr($word, 0, -1);
        }
        if (strlen($word) == 0){
            $i++;
        }
    }
    rsort($textArr);
    $count = count($textArr)-$i;
    $count = count($textArr)-$count;

    for ($j = 0; $j < ($count); $j++) {
        array_pop($textArr);
    }
    return $textArr;
}
/**
 * counts how many words in the testArr
 * @param array $textArr array of words
 * @return int number of words
 */
function wordCount(array $textArr)
{
    return count($textArr);
}
/**
 * calculates average word length
 * @param array $textArr
 * @param int $wordCount
 * @return float the average word length
 */
function wordLengthAverage(array $textArr, int $wordCount)
{
    $sumLength = 0;
    foreach ($textArr as $word) {
        $sumLength += strlen($word);
    }
    $sumLength = $sumLength/$wordCount;
    return round($sumLength , 3);
}
/**
 * calculates occurrence of each word length and puts in an array
 * @param array $textArr
 * @return array of different lengths in ascending order of length
 */
function wordLengthArr(array $textArr)
{
    $wordLengthArr = [];
    foreach ($textArr as $word) {
        $length = strlen($word);
        if (array_key_exists($length, $wordLengthArr)) {
            $wordLengthArr[$length]++;
        }else{
            $wordLengthArr[$length] = 1;
        }
    }
    ksort($wordLengthArr);
    return $wordLengthArr;
}
/**
 * calcualtes the most frequent word length and prints the length and occurance
 * @param $wordLengthArr
 */
function wordLengthFrequency($wordLengthArr)
{
    asort($wordLengthArr);
    $wordLengthArrCopy = $wordLengthArr;

    $highestCount = array_pop($wordLengthArrCopy);

    echo 'The most frequently occurring word length occurs ' . $highestCount . ' times, for word lengths of ';
    $i =0;
    foreach ($wordLengthArr as $key => $word) {
        if ($word === $highestCount) {
            if ($i > 0) {
                echo ' & ';
            }
            echo $key;
            $i++;
        }
    }
    echo '<br>';
}
