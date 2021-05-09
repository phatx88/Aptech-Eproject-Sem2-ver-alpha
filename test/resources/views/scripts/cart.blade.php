<script type="text/javascript">
        // $(document).ready(function() {
            fetch_btn();
            function fetch_btn(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('roll-button') }}',
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#roll-button').html(data);
                    }
                });
            }
        // });

        $(document).ready(function() {
            $('.check-shipping-fee').click(function() {
                var province_id = $('#province').val();
                var district_id = $('#district').val();
                var ward_id = $('#ward').val();
                var _token = $('input[name="_token"]').val();
                // alert(province_id);
                // alert(district_id);
                // alert(ward_id);
                if (province_id == '' && district_id == '' && ward_id == '') {
                    notyf.error('Select shipping destination first');
                } else {
                    $.ajax({
                        url: '{{ url('calculate-fee') }}',
                        method: 'POST',
                        data: {
                            province_id: province_id,
                            district_id: district_id,
                            ward_id: ward_id,
                            _token: _token
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(ma_id);
                if (action == 'province') {
                    result = 'district';
                } else if (action == 'district') {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{ url('select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        // alert (result);
                        $('#' + result).html(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.check_coupon').click(function() {
                var coupon_code = $('.counpon_code_cart').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('check/coupon') }}',
                    method: "POST",
                    data: {
                        coupon_code: coupon_code,
                        _token: _token
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.add-to-cart-details').click(function() {
                var id = $(this).data('id_product_details');
                var product_name = $('.product_name_cart_' + id).val();
                var product_price = $('.product_price_cart_' + id).val();
                var product_quantity = $('.product_quantity_cart_' + id).val();
                var product_image = $('.product_image_cart_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-to-cart') }}',
                    method: "POST",
                    data: {
                        id: id,
                        product_name: product_name,
                        product_price: product_price,
                        product_quantity: product_quantity,
                        product_image: product_image,
                        _token: _token
                    },
                    success: function(data) {
                        if(data == ''){
                            notyf.error('This item is not enough quantity!!!');
                        }else{
                            fetch_btn();
                            notyf.success('Cart Updated <a href="{{ url('cart') }}" class="text-dark">View Cart</a>');
                        }
                    }
                });
            });
        });

        $(document).ready(function(){
            $(".add-to-cart-related").click(function(){
                var cart = $('#shopping-bag-shake');
                    // var img = $('.product_image_cart_'+id).val();
                    var imgtodrag = $(this).parents('.items-products-related').find("img").eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({ top: imgtodrag.offset().top, left: imgtodrag.offset().left})
                            .css({
                            'opacity': '0.5',
                                'position': 'absolute',
                                'height': '150px',
                                'width': '150px',
                                'visibility': 'visible',
                                'z-index': '100'
                            })
                            .appendTo($('body'))
                            .animate({
                            'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 75,
                                'height': 75,
                                'visibility': 'visible'
                        }, 1000, 'easeInOutExpo');

                        setTimeout(function () {
                            cart.effect("shake", {
                                times: 1
                            }, 200);
                        }, 1500);

                        imgclone.animate({
                            'width': 0,
                                'height': 0

                        }, function () {
                            $(this).detach()
                        });
                    }
                var id = $(this).data("id_product");
                var product_name = $('.product_name_cart_' + id).val();
                var product_price = $('.product_price_cart_' + id).val();
                var product_quantity = $('.product_quantity_cart_' + id).val();
                var product_image = $('.product_image_cart_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-to-cart') }}',
                    method: "POST",
                    data: {
                        id: id,
                        product_name: product_name,
                        product_price: product_price,
                        product_quantity: product_quantity,
                        product_image: product_image,
                        _token: _token
                    },
                    success: function(data) {
                         // fetch_btn();
                         setTimeout(function () {
                            fetch_btn();
                        }, 1700);
                        notyf.success('Cart Updated <a href="{{ url('cart') }}" class="text-dark">View Cart</a>');
                    }
                });
            });
         });

         $(document).ready(function() {
            $(".add-to-cart").on('click',function() {
                ////////////////////////////////////////////////////////////////
                var cart = $('#shopping-bag-shake');
                    // var img = $('.product_image_cart_'+id).val();
                    var imgtodrag = $(this).parents('.items-products').find("img").eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({ top: imgtodrag.offset().top, left: imgtodrag.offset().left})
                            .css({
                            'opacity': '0.5',
                                'position': 'absolute',
                                'height': '150px',
                                'width': '150px',
                                'visibility': 'visible',
                                'z-index': '100'
                            })
                            .appendTo($('body'))
                            .animate({
                            'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 75,
                                'height': 75,
                                'visibility': 'visible'
                        }, 1000, 'easeInOutExpo');

                        setTimeout(function () {
                            cart.effect("shake", {
                                times: 1
                            }, 200);
                        }, 1500);

                        imgclone.animate({
                            'width': 0,
                                'height': 0

                        }, function () {
                            $(this).detach()
                        });
                    }
                ////////////////////////////////////////////////////////////////
                var id = $(this).data('id_product');
                var product_name = $('.product_name_cart_' + id).val();
                var product_price = $('.product_price_cart_' + id).val();
                var product_quantity = $('.product_quantity_cart_' + id).val();
                var product_image = $('.product_image_cart_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-to-cart') }}',
                    method: "POST",
                    data: {
                        id: id,
                        product_name: product_name,
                        product_price: product_price,
                        product_quantity: product_quantity,
                        product_image: product_image,
                        _token: _token
                    },
                    success: function(data) {
                        // fetch_btn();
                        setTimeout(function () {
                            fetch_btn();
                        }, 1700);

                        notyf.success('Cart Updated <a href="{{ url('cart') }}" class="text-dark">View Cart</a>');
                    }
                });

            });

            //quantity
            $(document).on('blur', '.quantity_cart_edit', function() {
                var id = $(this).data('quantity');
                var quantity = $('#quantity_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-cart-quantity') }}',
                    method: "POST",
                    data: {
                        id: id,
                        quantity: quantity,
                        _token: _token
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });

        });

        $('.delete-cart-product').click(function() {
            var id = $(this).data('id_delete');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/delete-cart-product') }}',
                method: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    location.reload();
                }
            });
        });


        $(document).ready(function() {
            $('#roll-button').on('click', '.delete-cart-product-button', function() {
                var id = $(this).data('id_delete');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/delete-cart-product') }}',
                    method: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(data) {
                        // location.reload();
                        fetch_btn();

                    }
                });
            });
        });


        $(document).ready(function() {
            $('.checkout-button').click(function(event) {
                event.preventDefault();
                swal({
                        title: "Xác nhận đơn hàng ?",
                        text: "Đơn hàng sẽ không được hoàn trả, bạn có muốn dặt không!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Đặt hàng",
                        cancelButtonText: "Quay lại",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm){
                            var user_name = $('.user-name-checkout').val();
                            var user_mobile = $('.user-mobile-checkout').val();
                            var user_email = $('.user-email-address').val();
                            var user_street_address = $('.user-street-address').val();
                            var province = $('#province').val();
                            var district = $('#district').val();
                            var ward = $('#ward').val();
                            var coupon_id =  $('.coupon-fee-checkout').val();
                            var _token = $('input[name="_token"]').val();
                            var fee_ship_checkout = $('.fee-ship-checkout').val();
                            var pay_method_checkout = $('.pay-method-checkout:checked').val();
                            // var check_box = $('.checkbox-checkout').val();
                            // alert(check_box);
                            var patt = new RegExp("[a-zA-Z ]{3,}");
                            var patt1 = new RegExp("[0-9]{10,12}");
                            var patt2 = new RegExp("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$");
                            var patt3 = new RegExp("[a-zA-Z0-9 ]{5,}");
                            // console.log(patt);
                            // console.log(patt.test(user_name));
                            // alert(pay_method_checkout);
                            if(patt.test(user_name) === false){
                                // alert('error');
                                swal("Lỗi","Name must be greater than 3", "error");
                            }
                            else if(patt1.test(user_mobile) == false){
                                swal("Lỗi","Mobile must be number and greater than 10", "error");
                            }
                            else if(patt2.test(user_email) == false){
                                swal("Lỗi","Email is not valid", "error");
                            }
                            else if(patt3.test(user_street_address) == false){
                                swal("Lỗi","Street is not valid", "error");
                            }else if(province === ""){
                                swal("Lỗi","Please choose Province ", "error");
                            }else if(district === ""){
                                swal("Lỗi","Please choose District ", "error");
                            }else if(ward === ""){
                                swal("Lỗi","Please choose Ward ", "error");
                            }else if(pay_method_checkout != 0 && pay_method_checkout != 1){
                                swal("Lỗi","Please choose Payment Method ", "error");
                            }
                            else if(user_name === "" || user_mobile === "" || user_email==="" || user_street_address==="" || province==="" || district ===""
                            || ward==="" || pay_method_checkout===""){
                                swal("Lỗi","You must fill all information", "error");

                             }else{
                                // imageUrl:'{{ asset('frontend/images/loading.gif') }}',
                                    $.ajax({
                                        url: '{{ url('/check-out-shopping') }}',
                                        method: "POST",
                                        data: {
                                            user_name: user_name,
                                            user_mobile: user_mobile,
                                            user_email:user_email,
                                            user_street_address:user_street_address,
                                            province:province,
                                            district:district,
                                            ward:ward,
                                            coupon_id:coupon_id,
                                            fee_ship_checkout:fee_ship_checkout,
                                            pay_method_checkout:pay_method_checkout,
                                            _token:_token
                                        },
                                        beforeSend: function(){
                                           swal({
                                            title: "Order Proccessing!",
                                            text: "Please wait for few second.",
                                            showCancelButton: false, // There won't be any cancel button
                                            showConfirmButton: false, // There won't be any confirm button
                                            imageUrl: "{{ asset('frontend/images/loading.gif') }}"
                                           });
                                        },
                                        success: function(data) {
                                            swal("Đơn hàng!", "Đơn hàng của bạn đã được gửi thành công.", "success");
                                            window.setTimeout(function (){
                                                window.location.href = "{{url('/cart')}}";
                                            }, 2000);
                                        }
                                     });


                            }

                        }else{
                            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                        }
                });
            });
        });




</script>
