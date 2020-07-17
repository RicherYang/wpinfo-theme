'use strict';

jQuery(function ($) {

    var data, recheckTimes;
    $('#add_url').on('click', function () {
        $('.url-info').addClass(['d-none']);

        data = $('#create_form').serializeObject();
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
                        if (Jdata.info == 'confirming') {
                            recheckTimes = 0;
                            setTimeout(recheck, 2500);
                        }
                    }
                }
            }
        });
    });

    function recheck() {
        var checkData = $('#create_form').serializeObject();
        if (JSON.stringify(checkData) == JSON.stringify(data)) {
            recheckTimes += 1;
            sendApi({
                url: ajaxInfo.url + '/check_url',
                data: data,
                method: 'POST',
                success: function (Jdata) {
                    if (Jdata.url !== undefined) {
                        window.location = Jdata.url;
                    }
                    if (Jdata.info !== undefined) {
                        if (Jdata.info == 'confirming') {
                            if (recheckTimes < 5) {
                                setTimeout(recheck, 2500);
                            }
                        }
                    }
                }
            });
        }
    }

});
