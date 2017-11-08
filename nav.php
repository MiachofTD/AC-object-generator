<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/25/17
 * Time: 10:14 PM
 */

use Illuminate\Http\Request;

$request = Request::capture();

$files = [
    'home' => 'index.php',
    'world item' => 'world-item.php',
    'jewelry' => 'jewelry.php',
    'armor' => 'armor.php',
    'melee weapon' => '#',
    'ranged weapon' => '#',
    'mage weapon' => '#',
];

echo '<h4 style="padding-top: 18px">';
foreach ( $files as $name => $file ) {
    if ( $file !== basename( $_SERVER[ 'REQUEST_URI' ] ) ) {
        echo '<a href="' . $file . '">' . $name . '</a> | ';
    }
    else {
        echo $name . ' | ';
    }
}
echo '</h4>';
