function formPriceTrade () {
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

$('#currencySelect').on('change',function(e) {
    let id = $(this).val();

    axios.post("/set-currency-trade-price", {id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            console.log(data)
    }).catch((error) => {
        console.log(error)
    });

    console.log($(this).val());
});

let $table = $('#tableRules')

function ajaxRequest(params) {
    let url = '/rules-trade-price-table'

    console.log(params.data)
    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
        console.log(res)
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
    return '<input type="number" class="input-text-table" value="'+value+'" >' + '<i class="bi bi-pencil"></i>' + '</input>'
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
    return '<input type="number" class="input-text-table" value="'+value+'" >' + '<i class="bi bi-pencil"></i>' + '</input>'
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
    return '<input type="number" class="input-text-table" value="'+value+'" >' + '<i class="bi bi-pencil"></i>' + '</input>'
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

function selectFormatter(value, row, index) {

    let options ='';
    options += window.data.map(item => {
        //console.log(item)
        return '<option value="' + item.id + '"' + (item.id === value ? 'selected' : '') + '>' + item.name + '</option>'
    });

    return '<select>' + options + '</select>'

}
    //return row.price_uploaded.map(item => item.name).join(', ');
window.selectEvents = {
    'change select': function (e, value, row, index) {
        row.id = +$(e.target).val()
        $table.bootstrapTable('updateRow', {
            index: index,
            row: row
        })
    }
}


$(function () {
    $table.on('check.bs.table check-all.bs.table uncheck.bs.table uncheck-all.bs.table',
        function (e, rowsAfter, rowsBefore) {
            let rows = rowsAfter
            if (e.type === 'uncheck-all') {
                rows = rowsBefore
            }
            let price_id = $.map(!$.isArray(rows) ? [rows] : rows, function (row) {
                return row.id
            })
            let checkbox = $.inArray(e.type, ['check', 'check-all']) > -1 ? 1 : 0

            let param = {
                price_id: price_id[0],
                checkbox: checkbox
            }

            axios.post("/is_active", {param},
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
/*            console.log(data, data.id)
            let newIndex = index +1
            $table.bootstrapTable('insertRow', {
                index: newIndex,
                row: data,
            })*/
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