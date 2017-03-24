<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Location
 *
 * @property int $id
 * @property int $coordinate_id
 * @property int $zipcode
 * @property string $city
 * @property string $state
 * @property-read \App\Coordinate $coordinate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Person[] $persons
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereCoordinateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereZipcode($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    protected $table = 'location';

    protected $fillable = ['zipcode','city','state'];

    public function coordinate(){
        return $this->belongsTo('App\Coordinate');
    }

    public function persons(){
        return $this->hasMany('App\Person');
    }
}
