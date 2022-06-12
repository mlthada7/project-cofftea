$(".pay-button").click(function (e) {
    e.preventDefault();

    var name = $(".name").val();
    var email = $(".email").val();
    var phone = $(".phone").val();
    var address = $(".address").val();
    var city = $(".city").val();
    var zipcode = $(".zipcode").val();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var data = {
        name: name,
        email: email,
        phone: phone,
        address: address,
        city: city,
        zipcode: zipcode,
    };

    $.ajax({
        type: "post",
        url: "/proceed-to-pay",
        data: data,
        success: function (response) {
            alert(response.total_price);
            //     // Set your Merchant Server Key
            // \Midtrans\Config::$serverKey = 'SB-Mid-server-XRexp-sFEOLxNSiktm3x3sqB';
            // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            // \Midtrans\Config::$isProduction = false;
            // // Set sanitization on (default)
            // \Midtrans\Config::$isSanitized = true;
            // // Set 3DS transaction for credit card to true
            // \Midtrans\Config::$is3ds = true;
            // $params = array(
            //     'transaction_details' => array(
            //         'order_id' => rand(),
            //         'gross_amount' => 10000,
            //     ),
            //     'customer_details' => array(
            //         'first_name' => 'budi',
            //         'last_name' => 'pratama',
            //         'email' => 'budi.pra@example.com',
            //         'phone' => '08111222333',
            //     ),
            // );
            // $snapToken = \Midtrans\Snap::getSnapToken($params);
        },
    });
});
