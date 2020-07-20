'use strict';

jQuery(function ($) {

    let wsCreate = {
        init: function () {
            $('#add_url').on('click', this.checkUrl);
        },

        checkUrl: function () {
            $.ajax({
                url: ajaxInfo.url + '/check_url',
                data: $('#add_form').serialize(),
                dataType: 'json',
                method: 'POST',
                beforeSend: function (Jdata) {
                    $('.url-info').addClass(['d-none']);
                    $('.getting').removeClass(['d-none']);
                },
                success: function (Jdata) {
                    if (Jdata.url !== undefined) {
                        window.location = Jdata.url;
                    }
                    if (Jdata.info !== undefined) {
                        let $info = $('.' + Jdata.info);
                        if ($info.length == 0) {
                            alert(Jdata.info);
                        } else {
                            $('.url-info').addClass(['d-none']);
                            $info.removeClass(['d-none']);
                        }
                    }
                }
            });
        },
    };

    wsCreate.init();
});
