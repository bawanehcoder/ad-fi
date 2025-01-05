<div class="tab-pane fade show active" id="dashboad">
    {{-- <div class="myaccount-content dashboad">
        <div class="alert alert-light">
              @langucw('your avaiable points') <b>{{getLogged()->totalPoints()}}</b>
              @langucw('profits') <b>{{getLogged()->convertPointstoMoney(getLogged()->totalPoints())}}</b>
        </div>
     <div class="alert alert-light">@langucw('referrals count') <b>{{getLogged()->usersIReferred()->count()}}</b></div>
 <div class="alert alert-light">@langucw('order count') <b>{{getLogged()->order->count()}}</b></div>
 <div class="alert alert-light">@langucw('user occasion count') <b>{{getLogged()->userOccasion()->count()}}</b></div>


    </div> --}}
    <div class="d-flex flex-row justify-content-between profile gap-2">
        <div class="d-flex flex-row w-50 align-items-center p-5  card-counter">
            <div class="counter">{{ getLogged()->totalPoints() }}</div>
            <h3 class="mx-4">@langucw('النقاط المتاحه')</h3>
        </div>
        <div class="d-flex flex-row  w-50 align-items-center p-5  card-counter">
            <div class="counter">{{ getLogged()->usersIReferred()->count() }}</div>
            <h3 class="mx-4">@langucw('الاحالات')</h3>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-between profile gap-2 mt-2">
        <div class="d-flex flex-row w-50 align-items-center p-5  card-counter">
            <div class="counter">{{ getLogged()->order->count() }}</div>
            <h3 class="mx-4">@langucw('عدد الطلبات')</h3>
        </div>
        <div class="d-flex flex-row  w-50 align-items-center p-5  card-counter">
            <div class="counter">{{ getLogged()->userOccasion()->count() }}</div>
            <h3 class="mx-4">@langucw('عدد المناسبات')</h3>
        </div>
    </div>

</div>
