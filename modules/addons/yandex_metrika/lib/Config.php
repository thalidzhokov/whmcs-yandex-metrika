<?php

/**
 * https://github.com/07artem132/whmcs-postpone-due-date/blob/master/lib/Config.php
 */

namespace WHMCS\Module\Addon\YandexMetrika;

use  WHMCS\Module\Addon\Setting;

/**
 * Class Config
 * @package WHMCS\Module\Addon\YandexMetrika
 */
class Config implements \ArrayAccess {
    private $config;

    /**
     * Config constructor.
     */
    function __construct() {
        array_walk( $this->load(), function ( $val, $key ) {
            $this->config[ $val['setting'] ] = $val['value'];
        } );
    }

    /**
     * @return array
     */
    function load(): array {
        return Setting::Module( 'yandex_metrika' )->get()->toArray();
    }

    /**
     * @return array
     */
    function toArray() {
        return (array) $this->config;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet( $offset, $value ) {
        if ( is_null( $offset ) ) {
            $this->config[] = $value;
        } else {
            $this->config[ $offset ] = $value;
        }
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists( $offset ) {
        return isset( $this->config[ $offset ] );
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset( $offset ) {
        unset( $this->config[ $offset ] );
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet( $offset ) {
        return isset( $this->config[ $offset ] ) ? $this->config[ $offset ] : null;
    }

}