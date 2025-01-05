<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Transformers\OrderDetailTransformer;
use Attribute;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

class OrderDetail extends Model implements Transformable,HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use HasMediaTrait;
    protected $CollectionName='images';
    protected $fillable = ['OrderID','ItemID','Quantity','Price','Note','OptID','blob'];

    public function setBlobAttribute(){
        $this->attributes['blob'] = '';
    }

    public function item(){
        return $this->belongsTo(Item::class,'ItemID') ;
     }

     public function sub(){
        return $this->belongsTo(SubOption::class,'OptID') ;
     }

     public function optionDetil(){
        return (!empty($this->OptID) && $this->OptID != '[]' )?OptionDetil::whereIn('id',json_decode($this->OptID)):null;
        // return $this->belongsTo(OptionDetil::class,'OptID');
    }

    public function optionDetilNew(){
        return OptionDetil::whereIn('id',json_decode($this->OptID))->get();
        // return (!empty($this->OptID) && $this->OptID != '[]' )?OptionDetil::whereIn('id',json_decode($this->OptID)):null;
        // return $this->belongsTo(OptionDetil::class,'OptID');
    }


    public function getBlobAttribute(){
       return $this->Price  * $this->Quantity;
    }


    public function getOptionDetilAttribute(){
        // dd($this->optionDetil);
        $return  ='';
        foreach ($this?->optionDetilNew() as $optionDetil){
            $return .=  $optionDetil->option->Name . "(" .$optionDetil->SubOption->Name . ')<br>';
        }
        // dd($return);
        return $return;
    }

    public function transformer()
    {
        return OrderDetailTransformer::class;
    }
}
