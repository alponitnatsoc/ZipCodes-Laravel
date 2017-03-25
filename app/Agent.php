<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Agent
 *
 * @property int $id
 * @property string $agent_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Person[] $contacts
 * @property-read \App\Person $person
 * @method static \Illuminate\Database\Query\Builder|\App\Agent whereAgentCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Agent whereId($value)
 * @mixin \Eloquent
 */
class Agent extends Model
{
    protected $table = 'agent';

    protected $fillable = ['agent_code'];

    public function contacts(){
        return $this->hasMany('App\Person');
    }

    public function person(){
        return $this->morphOne('App\person','personable');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'agent_code';
    }
}
