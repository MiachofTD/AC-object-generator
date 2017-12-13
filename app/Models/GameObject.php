<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

abstract class GameObject extends Model
{
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
}
