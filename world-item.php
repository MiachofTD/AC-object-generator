<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/25/17
 * Time: 9:08 PM
 */

require __DIR__ . '/vendor/autoload.php';

?>

<html>
    <head>
        <title>AC Custom Object Creator | World Item</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h2>World Item</h2>
                </div>
                <div class="col-md-10">
                    <?php require 'nav.php'; ?>
                </div>
            </div>
            <hr />
            <form action="create-object.php" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label for="id">ID</label>
                        <input type="text" name="id" class="form-control" id="id" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="wcid">Weenie Class ID</label>
                        <input type="text" name="wcid" class="form-control" id="wcid" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="loc">LOC Code</label>
                        <input type="text" name="loc" class="form-control" id="loc" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="objectType" value="world-item" />

                        <label for="submit">&nbsp;</label>
                        <input type="submit" class="form-control btn btn-success" value="Generate JSON" />
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
