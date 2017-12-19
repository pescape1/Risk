<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Operation
 * @package App\Models
 * @version November 10, 2017, 8:33 pm UTC
 *
 * @property string operation
 * @property string description
 * @property string operationscol
 */
class Operation extends Model
{

    public $table = 'operations';
    public $timestamps = false;



    public $fillable = [
        'operation',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'operation' => 'string',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function risks()
    {
        return $this->hasMany(\App\Models\Risk::class,'operation_id','id');
    }
}
