<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operator extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['blob','name_ar','name_en'];

    public function setBlobAttribute(){
        $this->attributes['blob'] = '';
    }
}
