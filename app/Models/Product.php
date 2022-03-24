<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public $timestamps = false;
    protected $fillable = [
        'product_name','user_id','product_desc','product_image','created_at','updated_at'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'product';
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
