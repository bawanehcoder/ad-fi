<script>
  function  offcanvasCart(){
    // alert('offcanvas');
      $.ajax({
          url: '{{route('cart.view_cart')}}',
          type: "get",
          beforeSend: function () {
              $('#cart_content').css({'opacity': 0.5});
          },
          success: function (data, textStatus, jqXHR) {
              $('#cart_content').html(data);
              $("html, body").animate({scrollTop: 0}, "slow");
          },
          error: function (XHR, textStatus, errorThrown) {

          },
          statusCode: {},
          complete: function (xhr, status) {
              $('#cart_content').css({'opacity': 1});
          },
      });
    }


    function  steptow(){
    // alert('offcanvas');
      $.ajax({
          url: '{{route('cart.steptow')}}',
          type: "get",
          beforeSend: function () {
              $('#cart_content').css({'opacity': 0.5});
          },
          success: function (data, textStatus, jqXHR) {
              window.location.replace("{{route('payment.show_payment_form2')}}")
          },
          error: function (XHR, textStatus, errorThrown) {

          },
          statusCode: {},
          complete: function (xhr, status) {
              $('#cart_content').css({'opacity': 1});
          },
      });
    }

    function  stepadd(){
    // alert('offcanvas');
      $.ajax({
          url: '{{route('cart.stepadd')}}',
          type: "get",
          beforeSend: function () {
              $('#cart_content').css({'opacity': 0.5});
          },
          success: function (data, textStatus, jqXHR) {
              $('#cart_content').html(data);
              $("html, body").animate({scrollTop: 0}, "slow");
          },
          error: function (XHR, textStatus, errorThrown) {

          },
          statusCode: {},
          complete: function (xhr, status) {
              $('#cart_content').css({'opacity': 1});
          },
      });
    }
</script>
