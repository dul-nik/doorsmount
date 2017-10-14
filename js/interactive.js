$(function() {
    $('#send-consultation').click(function () {
        var name = $('#InputName').val();
        var phone = $('#input-phone-consultation').val();
        $.post(
            '/scripts/order.php', 
            {name: name, phone: phone, type: 'consultation'}, 
            function (data) {
                $('#send-success').modal ('show');
                setTimeout(function () {
                    $('#send-success').modal ('hide');
                }, 5000);
            }
        ).fail(function() {
            $('#send-fail').modal ('show');
            setTimeout(function () {
                $('#send-fail').modal ('hide');
            }, 5000);
        });
        var name = $('#InputName').val('');
        var phone = $('#input-phone-consultation').val('');
    });

    $('#call-metering').click(function () {
        var name = '';
        var phone = $('#InputPhone').val();
        $.post(
            '/scripts/order.php', 
            {name: name, phone: phone, type: 'metering'}, 
            function (data) {
                $('#send-success').modal ('show');
                setTimeout(function () {
                    $('#send-success').modal ('hide');
                }, 5000);
            }
        ).fail(function() {
            $('#send-fail').modal ('show');
            setTimeout(function () {
                $('#send-fail').modal ('hide');
            }, 5000);
        });
        var phone = $('#InputPhone').val('');
    });

    $('#call-sale-btn').click(function (e) {
        e.preventDefault();
        var name = $('#call-sale-name').val();
        var phone = $('#call-sale-phone').val();
        $.post(
            '/scripts/order.php', 
            {name: name, phone: phone, type: 'sale'}, 
            function (data) {
                $('#send-success').modal ('show');
                setTimeout(function () {
                    $('#send-success').modal ('hide');
                }, 5000);
            }
        ).fail(function() {
            $('#send-fail').modal ('show');
            setTimeout(function () {
                $('#send-fail').modal ('hide');
            }, 5000);
        });
        var phone = $('#InputPhone').val('');
    });

    $('#modal-back-call').on('shown.bs.modal', function () {
        $('#InputName').focus();
    })  
});