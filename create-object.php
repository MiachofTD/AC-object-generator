<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/25/17
 * Time: 9:24 PM
 */

require __DIR__ . '/vendor/autoload.php';

use AC\Models\Armor;
use AC\Models\Jewelry;
use AC\Models\WorldItem;
use AC\Models\GameObject;
use Illuminate\Http\Request;

$request = Request::capture();

$object = null;
switch ( $request->get( 'objectType' ) ) {
    case 'world-item':
        $object = new WorldItem( $request );
    break;
    case 'jewelry':
        $object = new Jewelry( $request );
    break;
    case 'armor':
        $object = new Armor( $request );
    break;
    default:
    break;
}

?>

<html>
    <head>
        <title>AC Custom Object Creator | Results</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2>Results</h2>
                </div>
                <div class="col-md-9">
                    <?php require 'nav.php'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="javascript:void(0);" class="btn btn-primary" id="download">Download JSON</a>
                </div>
                <div class="col-md-10">
                    <pre>
<?php if ( $object instanceof GameObject ) {
    print_r( $object->convertToJson() );
} ?>
                    </pre>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).on('click', '#download', function ( el ) {
                var json = '<?php echo $object->convertToJson( false ) ?>';
                var data = 'text/json;charset=utf-8,' + json;

                $(this).attr('href', 'data:' + data);
                $(this).attr('download', "<?php echo $object->fileName ?>.json");
            });
        </script>
    </body>
</html>
