<script type="text/javascript">
    $(document).ready(function() {
        $('.add-to-wishlist').click(function(){
            var product_id = $(this).data('id_product');
            var user_id = $('.user_id_wishlist_'+product_id).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                    url: '{{ url('/add-to-wishlist') }}',
                    method: "POST",
                    data: {
                        product_id: product_id,
                        user_id: user_id,
                        _token: _token,

                    },
                    success: function(data) {
                        fetch_wishlist();
                        notyf.success('Updated <a href="{{ route('account.index') }}" class="text-dark"> View Wishlist</a>');

                    }
                });
        });
    });
        fetch_wishlist();
        function fetch_wishlist() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: '{{ url('/roll-button-wishlist') }}',
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#roll-button-wishlist').html(data);
                    }
                });
        }


        $(document).ready(function() {
            $('#roll-button-wishlist').on('click','.delete-wishlist-button', function() {
                var product_id = $(this).data('id_delete');
                var wishlist_id = $('.wish_list_id_'+ product_id).val();
                var _token = $('input[name="_token"]').val();
                // alert(product_id);
                // alert(wish_list_id);
                $.ajax({
                    url: '{{ url('/delete-button-wishlist') }}',
                    method: "POST",
                    data: {
                        wishlist_id: wishlist_id,
                        product_id:product_id,
                        _token: _token
                    },
                    success: function(data) {
                        // location.reload();
                        fetch_wishlist();
                        // notyf.success('<a>Delete Success</a>');
                    }
                });
            });
        });


        $(document).ready(function() {
            $('#wishlist_user_account').on('click','.delete-wishlist-button', function() {
                var product_id = $(this).data('id_delete');
                var wishlist_id = $('.wish_list_id_'+ product_id).val();
                var _token = $('input[name="_token"]').val();
                // alert(wishlist_id);
                // alert(product_id);
                $.ajax({
                    url: '{{ url('/delete-button-wishlist') }}',
                    method: "POST",
                    data: {
                        wishlist_id: wishlist_id,
                        product_id:product_id,
                        _token: _token
                    },
                    success: function(data) {
                        // location.reload();
                        fetch_wishlist();
                        notyf.success('<a>Delete Success</a>');
                    }
                });
            });
        });

</script>
