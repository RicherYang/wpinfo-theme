'use strict';

jQuery(function ($) {

    let wsCreate = {
        init: function () {
            $('#add_url').on('click', this.checkUrl);
        },

        checkUrl: function () {
            $('.url-info').addClass(['d-none']);
            let postData = $('#create_form').serializeObject();
            sendApi({
                url: ajaxInfo.url + '/check_url',
                data: postData,
                method: 'POST',
                success: function (Jdata) {
                    if (Jdata.url !== undefined) {
                        window.location = Jdata.url;
                    }
                    if (Jdata.info !== undefined) {
                        let $info = $('.' + Jdata.info);
                        if ($info.length == 0) {
                            alert(Jdata.info);
                        } else {
                            $info.removeClass(['d-none']);
                            if (Jdata.info == 'confirming') {
                                wsCreate.getInfo(Jdata.id);
                            }
                        }
                    }
                }
            });
        },

        getInfo: function (siteID) {
            sendApi({
                url: ajaxInfo.url + '/get_info',
                data: {
                    site_ID: siteID
                },
                method: 'POST',
                success: function (Jdata) {
                    if (Jdata.url !== undefined) {
                        window.location = Jdata.url;
                    }
                }
            });
        }
    };

    wsCreate.init();
});
