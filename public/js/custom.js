$(document).ready(function () {
    loadCart();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // UPDATE CART COUNT
    function loadCart() {
        $.ajax({
            type: "get",
            url: "/load-cart-data",
            success: function (response) {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
            },
        });
    }

    // Autofocus on modal form
    $("#editProfileModal").on("shown.bs.modal", function () {
        $(this).find("#name").focus();
    });

    // ADD TO CART
    $(".addToCartBtn").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product-data")
            .find(".product-id")
            .val();
        var product_qty = $(this)
            .closest(".product-data")
            .find(".qty-input")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // data dikirim ke controller sbgai request
        $.ajax({
            method: "post",
            url: "/add-to-cart",
            data: {
                product_id: product_id,
                product_qty: product_qty,
            },
            success: function (response) {
                loadCart();
                // window.location.reload();
                // swal("", response.statusSuccess, "success");
                // swal("", response.statusInfo, "info");
                swal(response.status);
            },
        });
    });

    // INCREMENT (+) BUTTON
    // $(".increment-btn").click(function (e) {
    $(document).on("click", ".increment-btn", function (e) {
        e.preventDefault();
        // var inc_value = $(".qty-input").val();
        var inc_value = $(this)
            .closest(".product-data")
            .find(".qty-input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            // $(".qty-input").val(value);
            $(this).closest(".product-data").find(".qty-input").val(value);
        }
    });

    // DECREMENT (-) BUTTON
    // $(".decrement-btn").click(function (e) {
    $(document).on("click", ".decrement-btn", function (e) {
        e.preventDefault();
        // var inc_value = $(".qty-input").val();
        var inc_value = $(this)
            .closest(".product-data")
            .find(".qty-input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            // $(".qty-input").val(value);
            $(this).closest(".product-data").find(".qty-input").val(value);
        }
    });

    // UPDATE CART QUANTITY
    // $(".changeQuantity").click(function (e) {
    $(document).on("click", ".changeQuantity", function (e) {
        e.preventDefault();
        var productId = $(this)
            .closest(".product-data")
            .find(".product-id")
            .val();
        var qty = $(this).closest(".product-data").find(".qty-input").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "update-cart",
            data: {
                product_id: productId,
                product_qty: qty,
            },
            success: function (response) {
                // loadCart();
                $(".cartItems").load(location.href + " .cartItems");
                // window.location.reload();
                // $(this).closest('.product-data').find('.qty-input').val();
                // alert(response);
                // swal("", response.status, "success");
            },
        });
    });

    // DELETE BUTTON (X)
    // $(".delete-btn").click(function (e) {
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product-data")
            .find(".product-id")
            .val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "post",
            url: "delete-cart-item",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                // window.location.reload();
                loadCart();
                $(".cartItems").load(location.href + " .cartItems");
                swal("", response.status, "success");
            },
        });
    });
});
