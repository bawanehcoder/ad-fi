@if ($product)
    @php
        $discount = app()
            ->make(\App\Services\DiscountService::class)
            ->getDiscountByItem($product);
    @endphp


    <div class="col-md-4">
        <div class="product-card ">
            <div class="product-img-wrapper">
                <a href="{{ route('products.show', $product) }}">

                    <img alt="cupcake" height="200" src="{{ asset($product->getFirstMediaUrl('products', 'full')) }}"
                        width="250" />
                </a>
                <span class="add-to-cart" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $product->id }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>اضف الى السلة</span>
                </span>
            </div>

            <a href="{{ route('products.show', $product) }}">


                <div class="card-content">
                    <p class="price">{{ $product->price() }} {{ $genralSetting->getCurrency() }}</p>
                    <h3>{{ $product->getTitle() }}</h3>
                </div>
            </a>
        </div>
    </div>



    <!-- Add to Cart -->
    <div class="modal  fade" id="exampleModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="cart-modal-head">
                        <div>
                            <div class="product-name">
                        {{ $product->getTitle() }}

                            </div>
                            <div class="product-price">
                                <div class="price">
                                    <span class="d-price" data-price="{{ $product->price() }}"></span>
                                    
                                    <span class="d-price-v"> {{ $product->price() }}</span> {{ $genralSetting->getCurrency() }}
                                </div>
                            </div>
                        </div>
                        @include('components.btn-number', ['id' => $product->id, 'quantity' => 1])

                    </div>

                    @php
                        $options = $product->optionDetil->groupBy('POptID');
                    @endphp
                    @if (count($options))
                        @include('components.product-option-detil', ['options' => $options])
                    @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note" class="required">@langucw('notes')</label>
                            <input class="form-control" type="text" id="note" name="note" value=""
                                placeholder="@langucw('notes')">
                        </div>
                    </div>

                    <button class="add-to-cart-btn button button-secondary" href="javaScript:void(0)"
                                    onclick="addToCart({{ $product->id }})">
                                    أضف للسلة
                                </button>
                    {{-- <button class="button button-primary">مشاهدة السلة</button> --}}
                </div>

            </div>
        </div>
    </div>
@endif
