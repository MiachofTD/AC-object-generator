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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'tier', 'int', 'bool', 'float', 'did', 'string', 'spellbook',
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
        $this->stats[ $this->type ][ 'int' ][ '1' ] = config( $this->configKey( 'item-type' ) . '.id' );

        //Set the body location
        $this->stats[ $this->type ][ 'int' ][ '9' ] = config( $this->configKey( 'body-location' ) . '.id' );

        $this->setAttribute( 'int', $this->addDefaults( 'int' ) );
        $this->setAttribute( 'bool', $this->addDefaults( 'bool' ) );
        $this->setAttribute( 'float', $this->addDefaults( 'float' ) );
        $this->setAttribute( 'did', $this->addDefaults( 'did' ) );
        $this->setAttribute( 'string', $this->addDefaults( 'string' ) );
        $this->spells = $this->addDefaults( 'spells' );

        foreach ( $this->spells as $spell ) {
            if ( $spell === 0 ) {
                continue;
            }
            $this->spellbook[ $spell ] = [ 'casting_likelihood' => array_get( $this->spellCastingLikelyhood, 'always', '' ) ];
        }
    }
}
