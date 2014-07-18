<?php

function parseAfirmative($a) {
    $tmp = strtolower(trim($a));
    if ($tmp == "y" || $tmp == "yes" || $tmp == "s" || $tmp == "sim") {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getOptions() {
    echo " [s/N] ";
    $line = trim(fgets(STDIN));
    return parseAfirmative($line);
}

function getLineFromStdin(&$final) {
    $line = trim(fgets(STDIN));
    if($line) {
        $final = $line;
    }
}