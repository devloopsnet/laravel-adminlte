(function ($) {

    $('select').select2();

    $('input').each(function () {
        let that = $(this);
        let name = that.attr('name') || '';
        if (name.indexOf('price') >= 0) {
            that.priceFormat({
                suffix: '',
                prefix: '',
                thousandsSeparator: ',',
                centsSeparator: '.',
                clearOnEmpty: true,
                centsLimit: 3
            });
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.fn.serializeControls = function () {
        let data = {};

        function buildInputObject(arr, val) {
            if (arr.length < 1)
                return val;
            let objkey = arr[0];
            if (objkey.slice(-1) === "]") {
                objkey = objkey.slice(0, -1);
            }
            let result = {};
            if (arr.length === 1) {
                result[objkey] = val;
            } else {
                arr.shift();
                let nestedVal = buildInputObject(arr, val);
                result[objkey] = nestedVal;
            }
            return result;
        }

        $.each(this.serializeArray(), function () {
            let val = this.value;
            let c = this.name.split("[");
            let a = buildInputObject(c, val);
            $.extend(true, data, a);
        });

        return data;
    };
})(jQuery);

window.alert = function(message){
    $.MessageBox(message);
};

function showError(error) {
    jQuery('#errorModal .modal-body').text(error);
    jQuery('#errorModal').modal('show');
}

Array.prototype.exists = function (attr, value) {
    for (let i = 0; i < this.length; i++) {
        if (this[i].hasOwnProperty(attr) && this[i][attr] == value) {
            return i;
        }
    }
    return -1;
};

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (elt /*, from*/) {
        var len = this.length >>> 0;

        var from = Number(arguments[1]) || 0;
        from = (from < 0) ? Math.ceil(from) : Math.floor(from);
        if (from < 0)
            from += len;

        for (; from < len; from++) {
            if (from in this &&
                this[from] === elt)
                return from;
        }
        return -1;
    };
}

function getRemoveBtn(productId) {
    return '<div class="btn-group" role="group" data-product-id="' + productId + '">' +
        '       <button type="button"class="order-remove-product btn btn-danger" data-product-id="' + productId + '">Remove</button>' +
        '   </div>';
}

function getQuantityField(productId, qty, stock, cartLimit) {
    return '<div class="input-group" style="width: 140px;">\n' +
        '                        <input type="hidden" class="product_id" name="products[' + productId + ']" value="' + productId + '">\n' +
        '                        <span class="input-group-btn">\n' +
        '                            <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">\n' +
        '                              <span class="fa fa-minus"></span>\n' +
        '                            </button>\n' +
        '                        </span>\n' +
        '                        <input type="text" id="quantity" name="quantity[' + productId + ']" class="form-control input-number quantity" value="' + qty + '" min="1" max="100">\n' +
        '                        <span class="input-group-btn">\n' +
        '                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-stock="' + stock + '" data-cart-limit="' + cartLimit + '" data-type="plus" data-field="">\n' +
        '                                <span class="fa fa-plus"></span>\n' +
        '                            </button>\n' +
        '                        </span>\n' +
        '                      </div>';
}