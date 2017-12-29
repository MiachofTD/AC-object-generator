<?php

namespace AC\Models;

use AC\Traits\Wearable;
use Illuminate\Http\Request;

class Jewelry extends GameObject
{
    use Wearable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'wcid';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jewelry';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'weenieType', 'tier', 'int', 'bool', 'float', 'did', 'string', 'spellbook',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'int' => 'array',
        'bool' => 'array',
        'float' => 'array',
        'did' => 'array',
        'string' => 'array',
        'spellbook' => 'array',
    ];

    /**
     * Stat values necessary for each jewelry type
     *
     * @var array
     */
    protected $stats = [
        'bracelet' => [
            'weenieType' => 2,
            'int' => [
                '9007' => 2,        //Weenie Type
            ],
            'did' => [
                '1' => 33554683,    //Ground Pallet
            ],
        ],
        'necklace' => [
            'weenieType' => 1,
            'int' => [
                '9007' => 1,        //Weenie Type
            ],
            'did' => [
                '1' => 33554689,    //Ground Pallet
            ],
        ],
        'ring' => [
            'weenieType' => 1,
            'int' => [
                '9007' => 1,        //Weenie Type
            ],
            'did' => [
                '1' => 33554691,    //Ground Pallet
            ],
        ],
    ];

    /**
     * @var array
     */
    protected $defaults = [
        'int' => [
            '16' => 1,          //Always Usable
            '53' => 101,        //Placement Position
            '93' => 1044,       //Physics State
        ],
        'bool' => [
            '11' => 1,          //Ignore Collision
            '13' => 1,          //Etherial
            '14' => 1,          //Gravity
            '19' => 1,          //Attackable
            '22' => 1,          //Inscribeable
        ],
        'did' => [
            '3' => 536870932,   //Sound Pallet
            '6' => 67111919,    //Color Pallet
            '22' => 872415275,  //Physics Effect
        ],
    ];

    /**
     * @var array
     */
    protected $optionalStats = [
        'int' => [
            '86' => 0,
            '87' => 0,
        ],
        'string' => [
            '16' => '',
        ],
    ];

    /**
     * @param Request $request
     *
     * @return void
     */
    public function mapData( Request $request )
    {
        parent::mapData( $request );

        $this->setAttribute( 'weenieType',  array_get( $this->stats, $this->type . '.weenieType' ) );

        //Set the item type
        $this->defaults[ 'int' ][ '1' ] = config( $this->configKey( 'item-type' ) . '.id' );

        //Set the body location
        $this->defaults[ 'int' ][ '9' ] = config( $this->configKey( 'body-location' ) . '.id' );

        //UI Effects
        $this->defaults[ 'int' ][ '18' ] = 0;

        //Pyreal Value
        $this->defaults[ 'int' ][ '19' ] = rand(
            config( $this->configKey( 'pyreal-value' ) . '.min' ),
            config( $this->configKey( 'pyreal-value' ) . '.max' )
        );

        //Bonded
        if ( !$request->has( 'int.33' ) ) {
            $this->defaults[ 'int' ][ '33' ] = 0;
        }

        //Item Workmanship
        $this->defaults[ 'int' ][ '105' ] = rand(
            config( $this->configKey( 'workmanship' ) . '.min' ),
            config( $this->configKey( 'workmanship' ) . '.max' )
        );

        //Attuned
        if ( !$request->has( 'int.114' ) ) {
            $this->defaults[ 'int' ][ '114' ] = 0;
        }

        $this->spells = $this->addDefaults( 'spells' );

        $spellbook = [];
        foreach ( $this->spells as $spell ) {
            if ( is_null( $spell ) || $spell === 0 ) {
                continue;
            }
            $spellbook[ $spell ] = [ 'casting_likelihood' => array_get( $this->spellCastingLikelyhood, 'always', '' ) ];
        }

        $this->setAttribute( 'spellbook', $spellbook );

        if ( !empty( $spells ) ) {
            //UI Effects
            $this->defaults[ 'int' ][ '18' ] = 1;

            //Spellcraft/Arcane Lore
            $arcaneLore = rand(
                config( $this->configKey( 'arcane-lore' ) . '.min' ),
                config( $this->configKey( 'arcane-lore' ) . '.max' )
            );

            $this->defaults[ 'int' ][ '106' ] = $arcaneLore;
            $this->defaults[ 'int' ][ '109' ] = $arcaneLore;

            //Mana Usage Rate
            $this->defaults[ 'float' ][ '5' ] = rand_float( 5, 33, 3 );
        }

        $this->setAttribute( 'int', $this->addDefaults( 'int' ) );
        $this->setAttribute( 'bool', $this->addDefaults( 'bool' ) );
        $this->setAttribute( 'float', $this->addDefaults( 'float' ) );
        $this->setAttribute( 'did', $this->addDefaults( 'did' ) );
        $this->setAttribute( 'string', $this->addDefaults( 'string' ) );
    }
}
