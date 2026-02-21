<?php

// GET passwordgen.bjoern-buettner.me/?l=19&c=a

$_GET['length'] = intval($_GET['length'] ?? $_GET['l'] ?? 10, 10);
$_GET['charset'] = $_GET['charset'] ?? $_GET['c'] ?? 'ascii';

$arrays = [
        'alphanumeric' => str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),
        'numeric' => str_split('1234567890'),
        'ascii' => str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_:.;,#+*~?=)(/&%$§!<>|°^\'"][{}'),
        'base64' => str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789=/+'),
        'hex' => str_split('ABCDEF0123456789'),
];

function toString(int $number, array $chars) {
        shuffle($chars);
        return $chars[$number];
}
function allToString(int $length, array $chars) {
        $toImplode = [];
        for($i = 0; $i < $length; $i++) {
                $toImplode[] = toString(random_int(0, count($chars) - 1), $chars);
        }
        return implode("", $toImplode);
}

switch($_GET['charset']) {
        case 'alphanumeric':
        case 'an':
                exit(allToString($_GET['length'], $arrays['alphanumeric']));
        case 'numeric':
        case 'n':
                exit(allToString($_GET['length'], $arrays['numeric']));
        case 'ascii':
                exit(allToString($_GET['length'], $arrays['ascii']));
        case 'base64':
        case 'b64':
                exit(allToString($_GET['length'], $arrays['base64']));
        case 'hex':
        case '16':
                exit(allToString($_GET['length'], $arrays['hex']));
        default:
                header("HTTP 422: Unprocessable Entity", true, 422);
}
