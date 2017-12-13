<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 12/12/17
 * Time: 9:18 PM
 */

namespace AC\Traits;

use LogicException;

trait Wearable
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
     * @var array
     */
    protected $spellCastingLikelyhood = [
        'always' => 2.0,
    ];

    /**
     * @param string 0$statType
     *
     * @return array
     */
    protected function addDefaults( $statType )
    {
        if ( !isset( $this->defaults ) ) {
            throw new LogicException( get_class( $this ) . ' must have a $defaults.' );
        }
        if ( !isset( $this->stats ) ) {
            throw new LogicException( get_class( $this ) . ' must have a $stats.' );
        }
        if ( !isset( $this->optionalStats ) ) {
            throw new LogicException( get_class( $this ) . ' must have a $optionalStats.' );
        }

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
     * @param $configType
     *
     * @return mixed
     */
    protected function configKey( $configType )
    {
        $configKeys = [];

        switch ( $this->type ) {
            case 'bracelet':
                $configKeys[ 'item-type' ] = 'item-type.jewelry';
                $configKeys[ 'body-location' ] = 'body-location.jewelry.either-wrist';
            break;

            case 'necklace':
                $configKeys[ 'item-type' ] = 'item-type.misc'; //Yes, I know 'misc' doesn't make sense
                $configKeys[ 'body-location' ] = 'jewelry.necklace';
            break;

            case 'ring':
                $configKeys[ 'item-type' ] = 'item-type.misc'; //Yes, I know 'misc' doesn't make sense
                $configKeys[ 'body-location' ] = 'jewelry.either-finger';
            break;

            case 'coat':
                $configKeys[ 'clothing-priority' ] = 'clothing-priority.armor.chest-ul-arms';
                $configKeys[ 'body-location' ] = 'body-location.armor.chest-ul-arms';
            break;
        }

        return array_get( $configKeys, $configType, '' );
    }
}
