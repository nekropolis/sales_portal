$(document).ready(function () {
    let input = document.getElementsByTagName("INPUT");
    for (let i = 0; i < input.length; i++) {
        input[i].oninvalid = function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Это поле обязательное!");
            }
        };
        input[i].oninput = function (e) {
            e.target.setCustomValidity("");
        };
    }
});

function formPriceTrade() {
    $('#modalWait').modal('show');

    axios.post("/form-trade-price", {},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        setTimeout(() => $('#modalWait').modal('hide'), 500)
        let type = data.type;
        switch (type) {
            case "info":
                toastr.info(data.message)
                break;
            case "success":
                toastr.success(data.message)
                break;
            case "warning":
                toastr.warning(data.message)
                break;
            case "error":
                toastr.error(data.message)
                break;
        }
    }).catch((error) => {
        console.log(error)
    });

}

$('#currencySelect').on('change', function (e) {
    let id = $(this).val();

    axios.post("/set-currency-trade-price", {id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        let type = data.type;
        switch (type) {
            case "info":
                toastr.info(data.message)
                break;
            case "success":
                toastr.success(data.message)
                break;
            case "warning":
                toastr.warning(data.message)
                break;
            case "error":
                toastr.error(data.message)
                break;
        }
    }).catch((error) => {
        console.log(error)
    });
});

let $table = $('#tableRules')

function ajaxRequest(params) {
    let url = '/rules-trade-price-table'

    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
    })
}

function queryParams(params) {
    const parseTable = document.getElementById('tablePriceParse');
    //let id = parseTable.getAttribute('data-id');

    delete params.sort
    delete params.order
    //params.id = id
    return params
}

function responseHandler(res) {
    if ($table.bootstrapTable('getOptions').sortOrder === 'desc') {
        res.rows = res.rows.reverse()
    }
    return res
}

function price_minFormatter(value) {
    return '<input type="number" class="input-text-table" value="' + value + '" >' + '<i class="bi bi-pencil"></i>' + '</input>'
}

window.price_minEvents = {
    'change :input': function (e, value, row, index) {
        let id = row.id;
        let price_min = e.target.value;

        axios.post("/edit-rule-trade-price", {id, price_min},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function price_maxFormatter(value) {
    return '<input type="number" class="input-text-table" value="' + value + '" >' + '<i class="bi bi-pencil"></i>' + '</input>'
}

window.price_maxEvents = {
    'change :input': function (e, value, row, index) {
        let id = row.id;
        let price_max = e.target.value;

        axios.post("/edit-rule-trade-price", {id, price_max},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function trade_marginFormatter(value) {
    return '<input type="text" class="input-text-table" value="' + value + '" >' + '<i class="bi bi-pencil"></i>' + '</input>'
}

window.trade_marginEvents = {
    'change :input': function (e, value, row, index) {
        let id = row.id;
        let trade_margin = e.target.value;

        axios.post("/edit-rule-trade-price", {id, trade_margin},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function sortFormatter(value) {
    return '<input type="number" class="input-text-table" value="' + value + '" >' + '<i class="bi bi-pencil"></i>' + '</input>'
}

window.sortEvents = {
    'change :input': function (e, value, row, index) {
        let id = row.id;
        let sort = e.target.value;

        axios.post("/edit-rule-trade-price", {id, sort},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterPriceUploaded(value, row, index) {
    let selectClassPriceUploaded = "multiple-select-price-uploaded-" + row.id
    $(document).ready(function () {
        $('#' + selectClassPriceUploaded).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
        let counter = document.getElementById('select2-' + selectClassPriceUploaded + '-container').children.length;
        if (counter > 3) {
            $('#select2-' + selectClassPriceUploaded + '-container')
                .hide()
                .after('<div style="line-height: 28px; padding: 5px;" class="counter">' + counter + ' выбрано</div>');
        }
    });

    let options = '';
    options += window.sellers.map(item => {
        let selectPriceUploaded = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectPriceUploaded !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="' + selectClassPriceUploaded + '" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsPriceUploaded = {
    'change select': function (e, value, row, index) {
        let pricesIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, pricesIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterCategory(value, row, index) {
    let selectClassCategory = "multiple-select-categories-" + row.id
    $(document).ready(function () {
        $('#' + selectClassCategory).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
        let counter = document.getElementById('select2-' + selectClassCategory + '-container').children.length;
        if (counter > 3) {
            $('#select2-' + selectClassCategory + '-container')
                .hide()
                .after('<div style="line-height: 28px; padding: 5px;" class="counter">' + counter + ' выбрано</div>');
        }
    });
    let options = '';
    options += window.categories.map(item => {
        let selectCategories = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectCategories !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="' + selectClassCategory + '" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsCategory = {
    'change select': function (e, value, row, index) {
        let categoriesIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, categoriesIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterBrand(value, row, index) {
    let selectClassBrand = "multiple-select-brands-" + row.id
    $(document).ready(function () {
        $('#' + selectClassBrand).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
        let counter = document.getElementById('select2-' + selectClassBrand + '-container').children.length;
        if (counter > 3) {
            $('#select2-' + selectClassBrand + '-container')
                .hide()
                .after('<div style="line-height: 28px; padding: 5px;" class="counter">' + counter + ' выбрано</div>');
        }
    });

    let options = '';
    options += window.brands.map(item => {
        let selectBrands = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectBrands !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="' + selectClassBrand + '" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsBrand = {
    'change select': function (e, value, row, index) {
        let brandsIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, brandsIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('updateByUniqueId', {
                        id: data.rulesTrade[0].id,
                        row: data.rulesTrade[0]
                    })
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
        }).catch((error) => {
            console.log(error)
        });
    }
}


$(function () {
    $table.on('check.bs.table check-all.bs.table uncheck.bs.table uncheck-all.bs.table',
        function (e, rowsAfter, rowsBefore) {
            let rows = rowsAfter
            if (e.type === 'uncheck-all') {
                rows = rowsBefore
            }
            let ids = $.map(!$.isArray(rows) ? [rows] : rows, function (row) {
                return row.id
            })
            let id = ids[0];
            let is_active = $.inArray(e.type, ['check', 'check-all']) > -1 ? 1 : 0

            axios.post("/edit-rule-trade-price", {id, is_active},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                let type = data.type;
                switch (type) {
                    case "info":
                        toastr.info(data.message)
                        break;
                    case "success":
                        toastr.success(data.message)
                        $table.bootstrapTable('updateByUniqueId', {
                            id: data.rulesTrade[0].id,
                            row: data.rulesTrade[0]
                        })
                        break;
                    case "warning":
                        toastr.warning(data.message)
                        break;
                    case "error":
                        toastr.error(data.message)
                        break;
                }
            }).catch((error) => {
                console.log(error)
            });
        });
});

function deleteFormatter(value, row, index) {
    return [
        '<a class="copy" href="javascript:void(0)" title="Copy">',
        '<i class="bi bi-copy"></i>',
        '</a>  ',
        '<a class="remove text-danger" href="javascript:void(0)" title="Remove">',
        '<i class="bi bi-trash3"></i>',
        '</a>'
    ].join('')
}

window.deleteEvents = {
    'click .copy': function (e, value, row, index) {
        let copy = 'copy';
        let id = row.id;

        axios.post("/edit-rule-trade-price", {copy, id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            let type = data.type;
            switch (type) {
                case "info":
                    toastr.info(data.message)
                    break;
                case "success":
                    toastr.success(data.message)
                    $table.bootstrapTable('refresh')
                    break;
                case "warning":
                    toastr.warning(data.message)
                    break;
                case "error":
                    toastr.error(data.message)
                    break;
            }
            $table.bootstrapTable('refresh')
        }).catch((error) => {
            console.log(error)
        });
    },
    'click .remove': function (e, value, row, index) {
        let retVal = confirm('Подтвердить удаление?')
        let rule_id = row.id;

        if (retVal === true) {
            axios.post("/delete-rule-trade-price", {rule_id},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                let type = data.type;
                switch (type) {
                    case "info":
                        toastr.info(data.message)
                        break;
                    case "success":
                        toastr.success(data.message)
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        })
                        break;
                    case "warning":
                        toastr.warning(data.message)
                        break;
                    case "error":
                        toastr.error(data.message)
                        break;
                }
            }).catch((error) => {
                console.log(error)
            });
        } else {
            e.preventDefault();
        }
    }
}

function createRules() {
    $('#rule').modal('show');

}