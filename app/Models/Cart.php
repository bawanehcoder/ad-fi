<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Transformers\CartTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use function PHPUnit\Framework\isEmpty;

class Cart extends Model implements Transformable,HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use HasMediaTrait;
    protected $fillable = ['user_id', 'temp_user_id', 'product_id', 'quantity', 'discount', 'shipping_cost', 'tax', 'price', 'address_id','OptID','Note'];
    protected $CollectionName='images';

    public function setBlobAttribute(){
        $this->attributes['blob'] = '';
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'product_id');
    }

    public function transformer()
    {
        return CartTransformer::class;
    }
    public function subOptions(){
        return $this->belongsTo(SubOption::class,'OptID');
    }
    public function optionDetil(){

       return (!empty($this->OptID) && $this->OptID != '[]' )?OptionDetil::whereIn('id',json_decode($this->OptID)):null;

//        return $this->belongsTo(OptionDetil::class,'OptID');
    }
}
