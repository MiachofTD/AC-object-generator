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

if (
    (
        strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Chrome' ) === false &&
        strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Firefox' ) === false &&
        strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Safari' ) === false
    ) || strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Edge' ) !== false
) { ?>
    <div class="row">
        <div class="alert alert-warning col-xs-10">
            This application is not guaranteed compatible with your browser. Please switch to Chrome if you have any issues.
        </div>
    </div>
<?php }
