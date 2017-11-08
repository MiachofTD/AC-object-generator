<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/6/17
 * Time: 5:56 PM
 */

require __DIR__ . '/vendor/autoload.php';

?>

<html>
    <head>
        <title>AC Custom Object Creator | Jewelry</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h2>Armor</h2>
                </div>
                <div class="col-md-10">
                    <?php require 'nav.php'; ?>
                </div>
            </div>
            <hr />
            <form action="create-object.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="file-name">File Name</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="fileName" id="file-name" required />
                            <span class="input-group-addon">.json</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="armor-type">Armor Type</label>
                        <select name="type" id="armor-type" class="form-control" required>
                            <option value="">-- Select One --</option>
                            <option value="coat">Coat</option>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="wcid">Weenie Class ID</label>
                        <input type="number" name="wcid" class="form-control" id="wcid" required />
                    </div>
                    <div class="col-md-6">
                        <label for="icon">Icon</label>
                        <select name="did[8]" id="icon" class="form-control" required>
                            <option>-- Select One --</option>
                            <?php echo dropdown_category( 'icons.armor.coat', 'Coats' ); ?>
                        </select>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <label for="item-name">Item Name</label>
                        <input type="text" name="string[1]" class="form-control" id="item-name" required />
                    </div>
                    <div class="col-md-6">
                        <label for="additional-description">Additional Description</label>
                        <input type="text" name="string[16]" class="form-control" id="additional-description" />
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="pyreal-value">Pyreal Value</label>
                        <input type="number" name="int[19]" class="form-control" id="pyreal-value" required />
                    </div>
                    <div class="col-md-6">
                        <label for="burden-value">Burden Value</label>
                        <input type="number" name="int[5]" class="form-control" id="burden-value" required />
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="player-min">Player Min Level</label>
                        <input type="number" name="int[86]" class="form-control" id="player-min" />
                    </div>
                    <div class="col-md-6">
                        <label for="player-max">Player Max Level</label>
                        <input type="number" name="int[87]" class="form-control" id="player-max" />
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="material-type">Material Type</label>
                        <select name="int[131]" class="form-control" id="mana-rate" required>
                            <option value="">-- Select One --</option>
                            <?php
                                echo dropdown_options( 'material-type.metal' );
                                echo dropdown_options( 'material-type.leather' );
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="pallet-template">Pallet Template</label>
                        <select name="int[3]" class="form-control" id="pallet-template">
                            <option value="">-- Select One --</option>
                            <?php echo dropdown_options( 'pallet-template' ); ?>
                        </select>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <label for="slash-protection">Slashing Protection</label>
                        <select name="float[13]" class="form-control" id="slash-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="pierce-protection">Piercing Protection</label>
                        <select name="float[14]" class="form-control" id="pierce-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="bludgeon-protection">Bludgeoning Protection</label>
                        <select name="float[15]" class="form-control" id="bludgeon-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="cold-protection">Cold Protection</label>
                        <select name="float[16]" class="form-control" id="cold-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fire-protection">Fire Protection</label>
                        <select name="float[17]" class="form-control" id="fire-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="acid-protection">Acid Protection</label>
                        <select name="float[18]" class="form-control" id="acid-protection">
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="electric-protection">Electrical Protection</label>
                        <select name="float[19]" class="form-control" id="electric-protection">
                            <option value="">-- Select One --</option>
                            <option value="0.0">No Protection</option>
                            <option value="0.1">0.1</option>
                            <option value="0.2">0.2</option>
                            <option value="0.3">0.3</option>
                            <option value="0.4">0.4</option>
                            <option value="0.5">0.5</option>
                            <option value="0.6">0.6</option>
                            <option value="0.7">0.7</option>
                            <option value="0.8">0.8</option>
                            <option value="0.9">0.9</option>
                            <option value="1.0">1.0</option>
                            <option value="1.1">1.1</option>
                            <option value="1.2">1.2</option>
                            <option value="1.3">1.3</option>
                            <option value="1.4">1.4</option>
                            <option value="1.5">1.5</option>
                            <option value="1.6">1.6</option>
                            <option value="1.7">1.7</option>
                            <option value="1.8">1.8</option>
                            <option value="1.9">1.9</option>
                            <option value="2.0">Max Protection</option>
                        </select>
                    </div>
                    <div class="col-md-6">&nbsp;</div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <label for="current-mana">Current Mana Value</label>
                        <input type="number" name="int[107]" class="form-control" id="current-mana" />
                    </div>
                    <div class="col-md-6">
                        <label for="max-mana">Maximum Mana Value</label>
                        <input type="number" name="int[108]" class="form-control" id="max-mana" />
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="arcane-lore">Player Acrane Lore Level</label>
                        <input type="number" name="int[109]" class="form-control" id="arcane-lore" />
                        <input type="hidden" name="int[106]" id="spellcraft" />
                    </div>
                    <div class="col-md-6">
                        <label for="mana-rate">Mana Usage Rate</label>
                        <select name="float[5]" class="form-control" id="mana-rate">
                            <option value="">-- Select One --</option>
                            <?php echo dropdown_options( 'mana-usage'); ?>
                        </select>
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="spells">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Creature Spells</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>Item Spells</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>Life Spells</h4>
                        </div>
                    </div>

                    <div class="row spell">
                        <div class="col-md-4">
                            <select name="spells[]" class="form-control">
                                <option value="">-- Select One --</option>
                                <?php echo dropdown_options_group( 'spells.creature' ); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="spells[]" class="form-control">
                                <option value="">-- Select One --</option>
                                <?php echo dropdown_options_group( 'spells.item' ); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="spells[]" class="form-control">
                                <option value="">-- Select One --</option>
                                <?php echo dropdown_options_group( 'spells.life' ); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span class="btn btn-primary form-control add-item">Add More Spells</span>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="objectType" value="armor" />

                        <label for="submit">&nbsp;</label>
                        <input type="submit" class="form-control btn btn-success" value="Generate JSON" />
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            function addItem() {
                const html = $('div.spell').last().html();
                const item = document.createElement('div');

                item.setAttribute('class', 'row spell');

                item.innerHTML = html;
                //If there are any values in any input or textarea, reset them.
                $(item).find('input').each(function (key, element) {
                    $(element).val('');
                });

                return item;
            }

            $(document).ready(function () {
                $(document).on('click', '.add-item', function () {
                    //Create new item
                    const spells = $('.spells');
                    spells.append(addItem());

                    const item = document.createElement('div');
                    item.setAttribute('class', 'row');
                    item.innerHTML = "&nbsp;";
                    spells.append(item, '');
                });

                $('#arcane-lore').on('change', function () {
                    $('#spellcraft').val($(this).val());
                });

                var spells = 'select[name="spells[]"]';
                $(document).on('change', spells, function() {
                    var count = $(spells).filter(function () {
                        return !!this.value;
                    }).length;

                    if ( count > 0 ) {
                        $('#arcane-lore').prop('required', true);
                        $('#mana-rate').prop('required', true);
                        $('#current-mana').prop('required', true);
                        $('#max-mana').prop('required', true);
                    }
                    else {
                        $('#arcane-lore').prop('required', false);
                        $('#mana-rate').prop('required', false);
                        $('#current-mana').prop('required', false);
                        $('#max-mana').prop('required', false);
                    }
                });
            });
        </script>
    </body>
</html>
