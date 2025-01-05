<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class MainCategoriesRepository implements RepositoryInterface
{

    public function getAll()
    {
       return Category::all();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function delete($id)
    {
        return Category::findOrFail($id)->delete();
    }
    public function get(){
        // return Cache::remember('main_categories', 86400, function () {
            return Category::where('CatID',0)->where('Visible',1)->where('ShortcutName', '<',1000)->orderBy('SortIndex','ASC')->get();
        // });

    }


    public function getByType($rtype = 'inside'){
        // return Cache::remember('main_categories', 86400, function () {
            return Category::where('CatID',0)->where('Visible',1)->where('rtype', $rtype)->orderBy('SortIndex','ASC')->get();
        // });

    }


    public function getSub($id){
        // return Cache::remember('main_categories', 86400, function () {
            return Category::where('CatID',$id)->where('Visible',1)->where('ShortcutName', '<',1000)->orderBy('SortIndex','ASC')->get();
        // });

    }
}
