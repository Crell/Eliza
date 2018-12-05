<?php

require_once('src/Eliza.php');

error_reporting(E_ALL | E_STRICT);

function prompt(string $out) : string
{
    fwrite(STDOUT, 'Eliza: ' . $out . PHP_EOL . '> ');
    $response = trim(fgets(STDIN));
    return $response;
}

function main() : void
{
    $e = new \Crell\Eliza\Eliza();

    $elizaSays = 'I am Eliza.  How are you today?';

    do {
        $userSays = prompt($elizaSays);
        $elizaSays = $e->analyze($userSays);
    } while (!in_array(strtolower($userSays), ['exit', 'bye', 'goodbye']));

    fwrite(STDOUT, 'Eliza: Thank you for talking with me.' . PHP_EOL);

    //print $e->analyze('I need help.') . PHP_EOL;
}

main();
