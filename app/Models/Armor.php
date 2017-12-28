<?php

namespace AC\Models;

use AC\Traits\Wearable;
use Illuminate\Http\Request;

class Armor extends GameObject
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
    protected $table = 'armor';

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
        'coat' => [
            'weenieType' => 2,
            'int' => [
                '9' => 196608,      //Location
                '9007' => 2,        //Weenie Type
            ],
            'did' => [
//                '1' => 33554854,    //Ground Pallet
//                '7' => 268435873,   //Clothing Base
//                '8' => 100670435,   //Icon
            ]
        ],
    ];

    /**
     * @var array
     */
    protected $defaults = [
        'int' => [
            '16' => 1,          //Always Usable
            '18' => 1,          //UI Effects
            '27' => 8,          //Armor Type???
            '53' => 101,        //Placement Position
            '93' => 1044,       //Physics State
            '158' => 0,         //Wield Requirement
            '159' => 0,         //Skill Type
            '160' => 0,         //Wield Difficulty
            '169' => 118097668, //TSYS Mutation Data
            '270' => 0,         //Wield Requirement 2
            '271' => 0,         //Skill Type 2
            '272' => 0,         //Wield Difficulty 2
        ],
        'bool' => [
            '11' => 1,          //Ignore Collision
            '13' => 1,          //Etherial
            '14' => 1,          //Gravity
            '22' => 1,          //Inscribeable
            '100' => 1,         //Dyeable
        ],
        'did' => [
            '3' => 536870932,   //Sound Pallet
            '6' => 67108990,    //Pallet Base
            '22' => 872415275,  //Physics Effect
            '36' => 234881042,  //Mutate Filter
            '46' => 939524146,  //TSYS Mutation Filter
        ]
    ];

    /**
     * @var array
     */
    protected $optionalStats = [
        'int' => [
            '86' => 0,          //Min Player Level
            '87' => 0,          //Max Player Level
        ],
        'string' => [
            '16' => '',
        ]
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
        $this->defaults[ 'int' ][ '1' ] = config( 'item-type.armor.id' );

        //Clothing Priority
        $this->stats[ $this->type ][ 'int' ][ '4' ] = config( $this->configKey( 'clothing-priority' ) . '.id' );

        //Set the body location
        $this->stats[ $this->type ][ 'int' ][ '9' ] = config( $this->configKey( 'body-location' ) . '.id' );

        //Item Workmanship
        $this->defaults[ 'int' ][ '105' ] = rand( 1, 10 );

        //Bonded
        if ( !$request->has( '33' ) ) {
            $this->stats[ $this->type ][ 'int' ][ '33' ] = 0;
        }
        //Attuned
        if ( !$request->has( '114' ) ) {
            $this->stats[ $this->type ][ 'int' ][ '114' ] = 0;
        }

        $this->setAttribute( 'int', $this->addDefaults( 'int' ) );
        $this->setAttribute( 'bool', $this->addDefaults( 'bool' ) );
        $this->setAttribute( 'float', $this->addDefaults( 'float' ) );
        $this->setAttribute( 'did', $this->addDefaults( 'did' ) );
        $this->setAttribute( 'string', $this->addDefaults( 'string' ) );
        $this->spells = $this->addDefaults( 'spells' );

        $spellbook = [];
        foreach ( $this->spells as $spell ) {
            if ( is_null( $spell ) || $spell === 0 ) {
                continue;
            }
            $spellbook[ $spell ] = [ 'casting_likelihood' => array_get( $this->spellCastingLikelyhood, 'always', '' ) ];
        }

        $this->setAttribute( 'spellbook', $spellbook );
    }
}
