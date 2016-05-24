<?php

namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Playoff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'playoffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['match_id', 'type', 'stage'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The Match instance of this playoff.
     *
     * @return array
     */
    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
