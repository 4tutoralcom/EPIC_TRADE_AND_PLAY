<?php

$json = file_get_contents('./php-properties/header.json');

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key:<br/>";
    } else {
        echo "$key => $val<br/>";
    }
}