'use strict';

function sendApi(args) {
    $.ajax($.extend({
        dataType: 'json',
        method: 'GET'
    }, args));
}

$.fn.serializeObject = function () {
    var obj = {},
        disabled = this.find(':input:disabled').prop('disabled', false);
    $.each(this.find(':input').serializeArray(), function () {
        if (obj[this.name] !== undefined) {
            if (!obj[this.name].push) {
                obj[this.name] = [obj[this.name]];
            }
            obj[this.name].push(this.value || '');
        } else {
            obj[this.name] = this.value || '';
        }
    });
    disabled.prop('disabled', true);
    return obj;
};
