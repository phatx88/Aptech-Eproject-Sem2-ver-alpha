<script type="text/javascript">
        $(document).ready(function() {
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
        });

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
                        $('#roll-button').html(data);
                        notyf.success('Cart Updated <a href="{{ url('cart') }}" class="text-dark">View Cart</a>');


                    }
                });
            });
        });

        $(document).ready(function(){
            $(".add-to-cart-related").click(function(){
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
                        $('#roll-button').html(data);
                        notyf.success('Cart Updated <a href="{{ url('cart') }}" class="text-dark">View Cart</a>');
                    }
                });
            });
         });

         $(document).ready(function() {
            $(".add-to-cart").click(function() {
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
                        $('#roll-button').html(data);
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
                        location.reload();

                    }
                });
            });
        });
</script>