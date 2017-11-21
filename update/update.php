<?php

$path = __DIR__.'/trivia/en/todo';

file_put_contents(__DIR__.'/trivia.json', json_encode(load($path)));

// ------------------------------------------------------------------------------------------------------------

function load($path)
{
    $questions = [];

    foreach (scandir($path) as $file) {
        if (!ends_with('.json', $file)) {
            continue;
        }

        $questions = array_merge($questions, readJsonFile("$path/$file"));
    }

    return $questions;
}

function ends_with($needle, $haystack)
{
    $length = strlen($needle);

    return $length === 0 ||
        (substr($haystack, -$length) === $needle);
}

function readJsonFile($file)
{
    echo "Reading file $file\n";

    $string = json_decode(loadAndFixJson($file), true);

    if (jsonError() !== false) {
        echo jsonError();
        die;
    }

    return $string;
}

function jsonError()
{
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return false;
        case JSON_ERROR_DEPTH:
            return ' - Maximum stack depth exceeded';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            return ' - Underflow or the modes mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
            return ' - Unexpected control character found';
            break;
        case JSON_ERROR_SYNTAX:
            return ' - Syntax error, malformed JSON';
            break;
        case JSON_ERROR_UTF8:
            return ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
        default:
            return ' - Unknown error';
            break;
    }

    return false;
}

function loadAndFixJson($file)
{
    $result = [];

    $file = file($file);

    if (trim($file[count($file)-1]) == ']') {
        unset($file[count($file)-1]);
    }

    if (trim($file[0]) == '[') {
        unset($file[0]);
    }

    foreach ($file as $key => $line) {
        $line = removeLastComma(trim($line));

        if (isValidJson($line)) {
            $result[] = "$line";
        }
    }

    return '[ ' . implode(",\n", $result) . ']';
}

function removeLastComma($jsonData)
{
    $result = preg_replace("/(},)/", "}", $jsonData);

    return $result;
}

function dd($line)
{
    d($line);
    die;
}

function d($line)
{
    var_dump($line);
}

function isValidJson($string)
{
    $string = '[ ' . removeLastComma($string) . ']';

    return is_array(json_decode($string, true));
}
