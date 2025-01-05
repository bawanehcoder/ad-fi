<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
    integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

@include('components.filter-logic-script')



<script>
    AOS.init();
    $(document).ready(function() {
        $('.main-slider').slick({
            rtl: true
        });
    });


    $(document).ready(function() {
        $('.product-list__wrapper').slick({
            rtl: true,
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 5,
        });

    });

    


    $(document).on('change', '.input-number', function() {
        let id = $(this).attr('att');
        let quy = $("#qty-" + id).val();
        let price = $(".price-" + id).html();
        let itemTotal = (quy * price).toFixed(2);
        $(".total_" + id).html(itemTotal);
        $(".subtotal_amount").html(getSubtotal());
    });

    function customUpdate(id){
        let quy = $("#qty-" + id).val();
        let price = $(".price-" + id).html();
        let itemTotal = (quy * price).toFixed(2);
        $(".total_" + id).html(itemTotal);
        $(".subtotal_amount").html(getSubtotal());
    }

    function getSubtotal() {
        let subtotal = 0;
        $("#table td .total ").each(function() {
            subtotal += parseFloat($(this).html())
        });
        return subtotal.toFixed(2);
    }

    // Handle the "plus" button click
    $(document).on("click",".plus" ,function() {
        let id = $(this).attr('att');
        let qtyInput = $("#qty-" + id);
        let currentValue = parseInt(qtyInput.val());
        qtyInput.val(currentValue + 1);
        customUpdate(id)
        qtyInput.change();
        // $(".subtotal_amount").html(getSubtotal());

    });

    // Handle the "mins" button click
    $(document).on("click",".mins", function() {
        let id = $(this).attr('att');
        let qtyInput = $("#qty-" + id);
        let currentValue = parseInt(qtyInput.val());
        if (currentValue > 1) { // Prevent value from going below 1
            qtyInput.val(currentValue - 1);
        }
        customUpdate(id)
        qtyInput.change();

    });


    function deleteItem($url) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        var confirmButtonText = "@langucw('delete')";
        swalWithBootstrapButtons.fire({
            title: "@langucw('Are you sure?')",
            text: "@langucw('You won`t be able to revert this')",
            icon: 'warning',
            position: 'center',
            showCancelButton: true,
            cancelButtonText: "@langucw('cancel')",
            confirmButtonText: confirmButtonText,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form').attr('action', $url);
                $('#delete-form').submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

            }
        })
    }


    $(document).on('change','input[name=qty]',function () {
        // alert('Please select');
        var quy = $(this).val();
        console.log(quy)
        var price = $(".d-price").attr('data-price');
        console.log(price)


        $('.d-price-v').html( price * quy )

    });

    $(document).on('change','#OptID',function () {
        // alert()
        var quy = $('input[name=qty]').val();
        console.log(quy)
        var price = $('#OptID option:selected').data('price');
        console.log(price)
        $(".d-price").attr('data-price',price)


        $('.d-price-v').html( price * quy )
    });

    function nextRoute(Url) {
        let _data = new Array();

        $(".input-number").each(function() {
            var rowId = $(this).attr('att');
            var id = $("#" + $(this).attr('id')).val();
            _data.push({
                "id": rowId,
                "num": id
            });
        });

        $.ajax({
            type: 'GET',
            url: Url,
            data: {
                data: JSON.stringify(_data)
            },
            // dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(response) {
                if (response.status == 200) {
                    window.location = '{{ Route('shipping_info.index') }}';
                }
            },
            complete: function(response) {

            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                    toastr.error(xhr.responseJSON.message)
                } else {
                    toastr.error("@langucw('an error occurred')")
                }
            }
        });
    }

    function delivery(price) {
        $("#delivery_price").html(price);
        calc();
    }

    function calc() {
        var subtotal = parseFloat($("#subtotal").html());
        var delivery_price = parseFloat($("#delivery_price").html());
        var discount = parseFloat($("#discount").html());
        var points = parseFloat($("#points").html());
        var total = parseFloat(subtotal + delivery_price - discount + points).toFixed(2);
        $('#amount_form').val(total);
        $("#total").html(total);
    }

    function branchPickup() {
        if ($("#branch_pickup").is(':checked')) {
            $('#delivery_type').val('personal_pickup');
        } else {
            $('#delivery_type').val('delivery_address');
        }
    }

    function CompleteReques() {
        if ($("#terms_conditions").is(':checked')) {
            $('#payment_method').val($('input[name="payment-method"]:checked').val());
            branchPickup();
            $('#delivery_form').val($('#address').find(":selected").val());
            $('#name_form').val($('#name_input').val());
            $('#phone_number_form').val($('#phone_number').val());
            $('#delivery_time').val($('.flatpickr-input').val());
            $('#notes').val($('#notes_textarea').val());
            $('#place_form').val($('#place').val());
            $('#branch_form').val($('#branch_pickup_s').val());
            $('#coupon_codee_form').val($('#coupon_code').val());
            $('#formMethod').submit();
        } else {
            toastr.error("@langucw('approval of the terms and conditions is required')")
        }
    }
</script>
