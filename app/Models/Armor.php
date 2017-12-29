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
            '16' => '',         //Additional Description
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
        $this->defaults[ 'int' ][ '1' ] = config( $this->configKey( 'item-type' ) . '.id' );

        //Clothing Priority
        $this->defaults[ 'int' ][ '4' ] = config( $this->configKey( 'clothing-priority' ) . '.id' );

        //Set the body location
        $this->defaults[ 'int' ][ '9' ] = config( $this->configKey( 'body-location' ) . '.id' );

        //UI Effects
        $this->defaults[ 'int' ][ '18' ] = 0;

        //Pyreal Value
        $this->defaults[ 'int' ][ '19' ] = rand(
            config( $this->configKey( 'pyreal-value' ) . '.min' ),
            config( $this->configKey( 'pyreal-value' ) . '.max' )
        );

        //Armor Level
        $this->defaults[ 'int' ][ '28' ] = rand(
            config( $this->configKey( 'armor-level' ) . '.min' ),
            config( $this->configKey( 'armor-level' ) . '.max' )
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

        //Slashing Protection
        $this->defaults[ 'float' ][ '13' ] = rand(
            config( 'protection.slashing.min' ),
            config( 'protection.slashing.max' )
        );

        //Piercing Protection
        $this->defaults[ 'float' ][ '14' ] = rand(
            config( 'protection.piercing.min' ),
            config( 'protection.piercing.max' )
        );

        //Bludgeoning Protection
        $this->defaults[ 'float' ][ '15' ] = rand(
            config( 'protection.bludgeoning.min' ),
            config( 'protection.bludgeoning.max' )
        );

        //Cold Protection
        $this->defaults[ 'float' ][ '16' ] = rand(
            config( 'protection.cold.min' ),
            config( 'protection.cold.max' )
        );

        //Fire Protection
        $this->defaults[ 'float' ][ '17' ] = rand(
            config( 'protection.fire.min' ),
            config( 'protection.fire.max' )
        );

        //Acid Protection
        $this->defaults[ 'float' ][ '18' ] = rand(
            config( 'protection.acid.min' ),
            config( 'protection.acid.max' )
        );

        //Electrical Protection
        $this->defaults[ 'float' ][ '19' ] = rand(
            config( 'protection.electrical.min' ),
            config( 'protection.electrical.max' )
        );

        //Nether Protection
        $this->defaults[ 'float' ][ '165' ] = rand(
            config( 'protection.nether.min' ),
            config( 'protection.nether.max' )
        );

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
