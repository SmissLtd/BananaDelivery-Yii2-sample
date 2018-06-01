$(function() {
    $('#form-calculate').submit(function() {
        $('#calculate-result').html('...');
        $.ajax({
            url: '/site/calculate',
            method: 'post',
            data: {
                count: $('#form-calculate input[name="count"]').val()
            },
            success: function (response) {
                $('#calculate-result').html(response);
            }
        });
        return false;
    });
});