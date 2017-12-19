<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    public $table = 'risks';
    public $timestamps = false;



    public $fillable = [
    	'operation_id',
        'risk',
        'detail'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'operation_id' => 'integer',
        'risk' => 'string',
        'detail' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function operations()
    {
        return $this->belongsTo(\App\Models\Operation::class,'operation_id','id');
    }
}
