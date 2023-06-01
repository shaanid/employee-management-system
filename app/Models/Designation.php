<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded  = [];

    //  protected $fillable = [

    // ];

    public function Users(){
        return $this->hasmany(User::class, 'position_id', 'id');
    }


}
