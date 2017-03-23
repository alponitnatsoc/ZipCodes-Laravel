<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Person
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Person whereName($value)
 * @mixin \Eloquent
 */
class Person extends Model
{
    //
    protected $table = 'person';

//    /**
//     * Get the route key for the model.
//     *
//     * @return string
//     */
//    public function getRouteKeyName()
//    {
//        return 'name';
//    }

}
