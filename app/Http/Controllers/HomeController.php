<?php

namespace App\Http\Controllers;

use App;
use App\Events\AppLanguageChangedEvent;
use App\Models\Slide;
use App\Repositories\GenralSettingRepository;
use App\Repositories\ItemRepository;
use App\Repositories\MainCategoriesRepository;
use App\Services\CartService;
use Artesaos\SEOTools\SEOMeta;
use Artesaos\SEOTools\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(public ItemRepository $productRepo,public GenralSettingRepository $genralSettingRepository){
        $this->productRepo = $productRepo;

    }


    public function index(Request $request)
    {

        $request->session()->put('app_language', strtolower('ar'));
        App::setLocale(strtolower($request->lang));

        if(isLogged()){
           // getLogged()->setPreferenceByName('user.notification_language', $request->lang);
            event(new AppLanguageChangedEvent(getLogged()));
        }

        // \SEO::setTitle(__('home'))
        //     ->setDescription(__('rwan cacke - home'));


        CartService::login($request);
        $sliders = Slide::all();
        return view('site.welcome', compact('sliders'));

    }

    public function aboutUs(){
        return view('site.about-us');
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
