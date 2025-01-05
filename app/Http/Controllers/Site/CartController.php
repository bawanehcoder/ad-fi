<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ShippingInfo;
use App\Models\Traits\MediaUploadingTrait;
use App\Models\Zones;
use App\Repositories\GenralSettingRepository;
use App\Services\CartService;
use App\Services\ConditionalDeliverieService;
use App\Services\ShippingInfoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    use MediaUploadingTrait;
    public function __construct(public GenralSettingRepository $genralSettingRepository)
    {
    }

    public function index(Request $request)
    {
        $carts = CartService::getCarts();
        if ($request->ajax() || $request->wantsJson()) {
            return \View::make('components.cart.offcanvas-cart', [
                'carts' => $carts,
                'genralSetting' => $this->genralSettingRepository,
            ])->render();
        }
        return view('site.cart.index', ['carts' => $carts, 'genralSetting' => $this->genralSettingRepository]);
    }

    public function stepTow(Request $request)
    {

        return redirect()->route('payment.show_payment_form2');

        session_start();
        $delivery_price = 0;
        $delivery_first_order = $this->genralSettingRepository->getDeliveryFirstOrderActive();
        $delivery_free = false;
        // if (getLogged() && $delivery_first_order && getLogged()->order()->count() == 0) {
            $delivery_price = 0;
            $delivery_free = true;
        // }
        $carts = CartService::getCarts();
        $conditional_deliverie = ConditionalDeliverieService::isConditionalDeliverie($carts);
        // if (count($carts) <= 0) {
        //     abort(404);
        // }
        // dd($carts);
        $subtotal = $discount = $price = 0;

        foreach ($carts ?? [] as $index => $cart) {

            $price =
                $cart->item->price() +
                ($cart->optionDetil() ? $cart->optionDetil()->sum('AdditionalValue') : 0);

            $subtotal += $price * $cart->quantity;
            $discount += \App\Services\DiscountService::getDiscountByItemFromCart($cart);

        }

        if (!auth()->user()) {
            return \View::make('components.cart.steplogin', [
                'genralSetting' => $this->genralSettingRepository,
            ])->render();
        } else {
            $carts = CartService::getCarts();
            $shipping_info = ShippingInfo::where('user_id', getLogged()->id)->get();

            return \View::make('components.cart.step2', [
                'carts' => $carts,
                'shipping_info' => $shipping_info,
                'genralSetting' => $this->genralSettingRepository,
                'currency' => $this->genralSettingRepository->getCurrency(),
                'coupona_active' => $this->genralSettingRepository->getCouponActive(),
                'delivery_first_order' => $delivery_first_order,
                'delivery_price' => ($conditional_deliverie > 0 && $subtotal >= $conditional_deliverie['purchase_value']) ? $conditional_deliverie['delivery'] : $delivery_price,
                'delivery_free' => $delivery_free,
                'conditional_deliverie' => $conditional_deliverie,
            ])->render();
        }
    }

    public function stepAdd(Request $request)
    {

        $zones = Zones::select('*')->get();

        return \View::make('components.cart.stepaddress', [
            'zones' => $zones,
            'genralSetting' => $this->genralSettingRepository,
        ])->render();

    }

    public function stepAddAdd(Request $request)
    {
        $request->id == null ? ShippingInfoService::storeFromRequest($request) : ShippingInfoService::updateFromRequest($request);
        if ($request) {
            // Authentication passed
            return response()->json(['success' => true, 'message' => 'Login successful']);
        } else {
            // Authentication failed
            return response()->json(['success' => false, 'message' => 'Invalid credentials']);
        }
    }

    public function addToCart(Request $request, Item $entity)
    {
        $add_cart = CartService::addToCart($request, $entity);
        switch ($add_cart) {
            case Response::HTTP_OK:
                return responder()->success(['count' => CartService::getCarts()->count()])->respond();
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                return responder()->error(500, __('something went wrong'))->respond();
        }

    }

    public function destroy(Request $request, Cart $entity)
    {
        $entity->forceDelete();
        return redirect()->back()->with('message', __('deleted successfully'));
    }

    public function cart_content()
    {
        $carts = CartService::getCarts();
        return view('components.cart.offcanvas-cart', ['carts' => $carts]);
    }
}
