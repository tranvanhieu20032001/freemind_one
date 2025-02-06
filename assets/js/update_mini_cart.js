jQuery(document).ready(function($) {

    function toggleCartElements() {
        var productQuantity = parseInt($('.cart-count').text(), 10);
        console.log("Product Quantity: ", productQuantity);
        if (productQuantity !== 0) {
            $('.cart-total-price').removeClass('d-none');
            $('.cart-count-wrapper').removeClass('d-none');
        }else{
            $('.cart-total-price').addClass('d-none');
            $('.cart-count-wrapper').addClass('d-none');
        }
    }

    // Kiểm tra ban đầu khi trang tải
    toggleCartElements();


    function update_mini_cart() {
        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'update_mini_cart'
            },
            success: function(response) {
                $('.mini-cart-content').html(response.mini_cart);
                $('.cart-count').text(response.cart_count);
                $('.cart-total-price').html(response.cart_total);
                console.log("Updated mini cart.......");
                toggleCartElements();
            },
            error: function(error) {
                console.error('Error updating mini cart:', error);
            }
        });
    }
    
    function update_mini_cart2() {
        console.log("Updating mini cart...");
        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'update_mini_cart2'
            },
            success: function(response) {
                if (response) {
                    console.log("Mini cart updated successfully.");
                    console.log(response); // Log dữ liệu trả về từ AJAX
                    $('.mini-cart-content').html(response.mini_cart);
                    $('.cart-count').text(response.cart_count);
                    $('.cart-total-price').html(response.cart_total);
                } else {
                    console.error('Response is empty');
                }
            },
            error: function(error) {
                console.error('Error updating mini cart:', error);
                console.log('Response text:', error.responseText); // Log response text for more details
            }
        });
    }
    

    // Sự kiện click cho nút "Update Cart" trên trang giỏ hàng
    $(document.body).on('click', '.actions .btn-update-cart', function(e) {
        setTimeout(()=>{
            update_mini_cart();
            toggleCartElements();

        },4000)
    });

    $(document.body).on('click', '.block-main-cart .icon-remove', function(e) {
        setTimeout(()=>{
            update_mini_cart();
            toggleCartElements();

        },4000)
    });


    $(document).on('click', '.add_to_cart_button', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product_id');
        var quantity = $(this).data('quantity') || 1; // Số lượng mặc định là 1
        
        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                // Xử lý sau khi thêm vào giỏ hàng thành công
                console.log('Sản phẩm đã được thêm vào giỏ hàng.');
                // Cập nhật lại giỏ hàng nhỏ và số lượng sản phẩm
                update_mini_cart();
                toggleCartElements();
            },
            error: function(error) {
                console.error('Error adding to cart:', error);
            }
        });
    });

    // Xử lý khi người dùng nhấp vào nút xóa sản phẩm
    $(document).on('click', '.remove_from_cart_button', function(e) {
        e.preventDefault();
        
        var cart_item_key = $(this).data('cart_item-key');
        
        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'remove_from_cart',
                cart_item_key: cart_item_key
            },
            success: function(response) {
                // Xử lý sau khi xóa thành công, ví dụ hiển thị thông báo
                console.log('Sản phẩm đã được xóa khỏi giỏ hàng.');
                // Cập nhật lại giỏ hàng nhỏ và số lượng sản phẩm
                update_mini_cart();
                toggleCartElements();
            },
            error: function(error) {
                console.error('Error removing product:', error);
            }
        });
    });

    // Xử lý khi người dùng nhấp vào nút xóa sản phẩm trên trang giỏ hàng
    $(document.body).on('click', '.woocommerce-cart-form__cart-item .product-remove a.remove', function(e) {
        e.preventDefault();
    
        var remove_url = $(this).attr('href'); // Lấy URL xóa sản phẩm
    
        $.ajax({
            url: remove_url,
            type: 'GET', // Phương thức GET để gọi URL xóa sản phẩm
            success: function(response) {
                // Sau khi xóa thành công, cập nhật lại giỏ hàng nhỏ và số lượng sản phẩm
                update_mini_cart();
                toggleCartElements();
                // Reload page if empty (optional)
                if ($('.cart-empty').length > 0) {
                    window.location.reload();
                }
            },
            error: function(error) {
                console.error('Error removing product:', error);
            }
        });
    });


  });