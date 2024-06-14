function formPriceTrade() {
    $('#modalWait').modal('show');

    axios.post("/form-trade-price", {},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
        $('#modalWait').modal('hide');
        //location.reload();
    }).catch((error) => {
        //$('#modalWaitParse').modal('hide');
        console.log(error)
    });

}

$('#currencySelect').on('change', function (e) {
    let id = $(this).val();

    axios.post("/set-currency-trade-price", {id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {

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
            $table.bootstrapTable('updateByUniqueId', {
                id: data.id,
                row: data
            })
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
            $table.bootstrapTable('updateByUniqueId', {
                id: data.id,
                row: data
            })
        }).catch((error) => {
            console.log(error)
        });
    }
}

function trade_marginFormatter(value) {
    return '<input type="number" class="input-text-table" value="' + value + '" >' + '<i class="bi bi-pencil"></i>' + '</input>'
}

window.trade_marginEvents = {
    'change :input': function (e, value, row, index) {
        let id = row.id;
        let trade_margin = e.target.value;

        axios.post("/edit-rule-trade-price", {id, trade_margin},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            $table.bootstrapTable('updateByUniqueId', {
                id: data.id,
                row: data
            })
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
            $table.bootstrapTable('updateByUniqueId', {
                id: data.id,
                row: data
            })
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterPriceUploaded(value, row, index) {
    $(document).ready(function () {
        $('#multiple-select-price-uploaded').select2({
            theme: "bootstrap-5",
            //width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
    });

    let options = '';
    options += window.sellers.map(item => {
        let selectPriceUploaded = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectPriceUploaded !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="multiple-select-price-uploaded" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsPriceUploaded = {
    'change select': function (e, value, row, index) {
        let pricesIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, pricesIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            $table.bootstrapTable('refresh')
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterCategory(value, row, index) {
    $(document).ready(function () {
        $('#multiple-select-categories').select2({
            theme: "bootstrap-5",
            //width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
    });
    console.log(value, row, window.categories)
    let options = '';
    options += window.categories.map(item => {
        let selectCategories = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectCategories !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="multiple-select-categories" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsCategory = {
    'change select': function (e, value, row, index) {
        let categoriesIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, categoriesIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            $table.bootstrapTable('refresh')
        }).catch((error) => {
            console.log(error)
        });
    }
}

function selectFormatterBrand(value, row, index) {
    $(document).ready(function () {
        $('#multiple-select-brands').select2({
            theme: "bootstrap-5",
            //width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            //placeholder: $( this ).data( 'placeholder' ),
            //closeOnSelect: false,
        });
    });

    let options = '';
    options += window.brands.map(item => {
        let selectBrands = value.find(o => o.id === item.id);
        return '<option value="' + item.id + '"' + (selectBrands !== undefined ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select class="form-select" id="multiple-select-brands" data-placeholder="Выбрать" multiple>' + options + '</select>'
}

window.selectEventsBrand = {
    'change select': function (e, value, row, index) {
        let brandsIds = $(e.target).val();
        let id = row.id;

        axios.post("/edit-rule-trade-price", {id, brandsIds},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            $table.bootstrapTable('refresh')
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
            let id = $.map(!$.isArray(rows) ? [rows] : rows, function (row) {
                return row.id
            })
            let is_active = $.inArray(e.type, ['check', 'check-all']) > -1 ? 1 : 0

            axios.post("/edit-rule-trade-price", {id, is_active},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                $table.bootstrapTable('updateByUniqueId', {
                    id: data.id,
                    row: data
                })
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
                {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id],
                })
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