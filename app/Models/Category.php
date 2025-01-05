<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;

use App\Models\Traits\StatusTrait;
use App\Transformers\CategoryTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Category extends Model implements HasMedia, Transformable
{
    use HasMediaTrait;
    use HasFactory;
    use StatusTrait;

    protected $CollectionName = 'categories';
    protected $fillable = [
        'id',
        'CatID',
        'Image',
        'blob',
        'Name',
        'NameEN',
        'ShortcutName',
        'ShortcutNameEN',
        'SortIndex',
        'Visible',
        'CategoryID',
        'rtype'
    ];

    public function setBlobAttribute(){
        $this->attributes['blob'] = '';
    }
    protected static $fieldStatusMapping = [
        'Visible' => 'statusMapping',

    ];
    protected static $statusMapping = [
        0 => [
            'codeName' => 'available',
        ],
        1 => [
            'codeName' => 'unavailable',
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'categories';
    }
    public function subCategory()
    {
        // return Cache::remember('main_categories' . $this->id, 86400, function () {
        return self::where('CatID', $this->id)->get();
        // });
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'CatID', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CatID', 'id')->where('CatID', 0);
    }
    
    public function mainCategory($id)
    {
        return self::where('id', $id)->first();
    }
    public function product()
    {
        return $this->hasMany(Item::class, 'CatID');
    }
    public function getName()
    {
        return getLang() == 'Ar' ? $this->Name : $this->NameEN;
    }
    public function transformer()
    {
        return CategoryTransformer::class;
    }



}
