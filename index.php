<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/25/17
 * Time: 8:06 PM
 */

$files = [
    'world item' => 'world-item.php',
    'jewelry' => 'jewelry.php',
    'armor' => 'armor.php',
    'melee weapon' => '#',
    'ranged weapon' => '#',
    'mage weapon' => '#',
];

?>

<html>
    <head>
        <title>AC Custom Object Creator</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Object Creator</h2>
                </div>
                <div class="col-md-10">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <?php foreach ( $files as $name => $file ) {
                            echo '<li style="font-size: 1.3em;"><a href="' . $file . '">' . $name . '</a>';
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
