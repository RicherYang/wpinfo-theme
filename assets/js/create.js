'use strict';

jQuery(function ($) {

    $('#add_url').on('click', function () {
        $('.url-info').addClass(['d-none']);

        var data = $('#create_form').serializeObject();
        sendApi({
            url: ajaxInfo.url + '/check_url',
            data: data,
            method: 'POST',
            success: function (Jdata) {
                if (Jdata.url !== undefined) {
                    window.location = Jdata.url;
                }
                if (Jdata.info !== undefined) {
                    var $info = $('.' + Jdata.info);
                    if ($info.length == 0) {
                        alert(Jdata.info);
                    } else {
                        $info.removeClass(['d-none']);
                    }
                }
            }
        });
    });

});
