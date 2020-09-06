<?php
$example = 'random string';

function reverseString(string $input) : string
{
    $Count = strlen($input);
    $reverse = '';

    for ($i = $Count; $i>0; $i--)
    {
        $reverse .= $input[$i-1];
    }
        return $reverse;
}
echo reverseString($example);