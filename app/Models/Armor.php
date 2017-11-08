<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/6/17
 * Time: 5:28 PM
 */

namespace AC\Models;

class Armor extends GameObject
{
    /**
     * @var string
     */
    public $fileName;

    /**
     * @var string
     */
    public $type;

    /**
     * Stat values necessary for each jewelry type
     *
     * @var array
     */
    protected $stats = [
        'coat' => [
            'weenieType' => 2,
            'int' => [
                '1' => 2,           //Item Type
                '9' => 196608,      //Location
                '9007' => 2,        //Weenie Type
            ],
            'did' => [
                '1' => 33554854,    //Ground Pallet
            ]
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
            '7' => 268435873,   //Clothing Base
            '22' => 872415275,  //Physics Effect
        ]
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
        ]
    ];

    /**
     * @var array
     */
    protected $spellCastingLikelyhood = [
        'always' => 2.0,
    ];

    /**
     * @var int
     */
    public $weenieType;

    /**
     * @var array
     */
    public $int = [];

    /**
     * @var array
     */
    public $bool = [];

    /**
     * @var array
     */
    public $float = [];

    /**
     * @var array
     */
    public $did = [];

    /**
     * @var array
     */
    public $string = [];

    /**
     * @var array
     */
    public $spellbook = [];

    /**
     * @var array
     */
    public $spells = [];

    /**
     * @param array $data
     *
     * @return void
     */
    protected function mapData( array $data )
    {
        parent::mapData( $data );

        $this->weenieType = array_get( $this->stats, $this->type . '.weenieType' );

        //Set the item type
        $this->stats[ 'coat' ][ 'int' ][ '1' ] = config( 'item-type.armor.id' );

        //Clothing Priority
        $this->stats[ 'coat' ][ 'int' ][ '4' ] = config( 'clothing-priority.armor.chest-ul-arms.id' );

        //Set the body location
        $this->stats[ 'coat' ][ 'int' ][ '9' ] = config( 'body-location.armor.chest-ul-arms.id' );

        $this->int = $this->addDefaults( 'int' );
        $this->bool = $this->addDefaults( 'bool' );
        $this->float = $this->addDefaults( 'float' );
        $this->did = $this->addDefaults( 'did' );
        $this->string = $this->addDefaults( 'string' );
        $this->spells = $this->addDefaults( 'spells' );

        foreach ( $this->spells as $spell ) {
            if ( $spell === 0 ) {
                continue;
            }
            $this->spellbook[ $spell ] = [ 'casting_likelihood' => array_get( $this->spellCastingLikelyhood, 'always', '' ) ];
        }
    }

    /**
     * @param string 0$statType
     *
     * @return array
     */
    protected function addDefaults( $statType )
    {
        $stats = $this->{$statType} +
            array_get( $this->defaults, $statType, [] ) +
            array_get( $this->stats, $this->type . '.' . $statType, [] );

        foreach ( $stats as $key => $value ) {
            if (
                ( empty( $value ) || $value === 0 ) &&
                array_has( $this->optionalStats, $statType . '.' . $key )
            ) {
                unset( $stats[ $key ] );
            }
        }

        switch ( $statType ) {
            case 'bool':
                foreach ( $stats as $key => $value ) {
                    $stat = filter_var( $value, FILTER_VALIDATE_BOOLEAN );
                    $stats[ $key ] = $stat ? 1 : 0;
                }
            break;
            case 'did':
            case 'int':
            case 'spells':
                $stats = array_map( 'intval', $stats );
            break;
            case 'float':
                $stats = array_map( 'floatval', $stats );
            break;
            case 'string':
                $stats = array_map( 'strval', $stats );
            break;
        }

        return $stats;
    }

    /**
     * @param bool $pretty
     *
     * @return string
     */
    public function convertToJson( $pretty = true )
    {
        $json = [
            'intStats' => $this->convertStatsToJson( $this->int ),
            'boolStats' => $this->convertStatsToJson( $this->bool ),
            'floatStats' => $this->convertStatsToJson( $this->float ),
            'didStats' => $this->convertStatsToJson( $this->did ),
            'stringStats' => $this->convertStatsToJson( $this->string ),
            'spellbook' => $this->convertStatsToJson( $this->spellbook ),
            'wcid' => (int)$this->wcid,
            'weenieType' => $this->weenieType,
        ];

        if ( $pretty ) {
            return json_encode( $json, JSON_PRETTY_PRINT );
        }

        return json_encode( $json );
    }
}
