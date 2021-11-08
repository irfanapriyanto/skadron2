<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estimate
 * @package App\Models
 * @version November 8, 2021, 11:52 am UTC
 *
 * @property integer $lanud_from
 * @property integer $lanud_to
 * @property time $est_time
 */
class Estimate extends Model
{
    use SoftDeletes;

    public $table = 'estimate';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function getFuelAttribute()
    {
        $airtime = $this->attributes['est_time'];
        $time1 = date('Y-m-d 00:00:00');
        $time2 = date('Y-m-d '.$airtime);
        $diff = strtotime($time2) - strtotime($time1);
        $minutes = $diff / 60;
        $countTime = (int)$minutes;
        $fuel = number_format((float)(700/60)*$countTime,2,'.','');

        // dd($fuel);
        return $fuel;
    }

    protected $appends = ['fuel'];



    public $fillable = [
        'lanud_from',
        'lanud_to',
        'est_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'lanud_from' => 'integer',
        'lanud_to' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'lanud_from' => 'required|integer',
        'lanud_to' => 'required|integer',
        'est_time' => 'nullable',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
