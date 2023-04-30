<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WebPointContact extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'web_point_contacts';
    protected $softDelete = true;
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable =['full_name','email','phone'];
}
