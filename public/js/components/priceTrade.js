let $table = $('#tableTradeZone')

function ajaxRequest(params) {
    let url = '/trade-table'
    console.log(params.data)
    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
        console.log(res, params)
    })
}

function queryParams(params) {
    delete params.sort
    delete params.order
    return params
}

function responseHandler(res) {
    if ($table.bootstrapTable('getOptions').sortOrder === 'desc') {
        res.rows = res.rows.reverse()
    }
    return res
}

function checkIcon() {
    $table.bootstrapTable('resetSearch');
}

function detailFormatter(index, row) {
    let html = []
    $.each(row, function (key, value) {
        if (key === 'product') {
            let list = `<div class="prise-models-in-product">`
            value.parse_models.map(items => {
                list += (`<div class="item-models">
                        <span>- ${items.model} | </span>
                        <span>${items.quantity} шт. | </span>
                        <span>${items.price} ${items.price_uploaded.currency.code} | </span>
                        <span>${items.price_uploaded.name}</span>
                        </div>`)
            })
                list += '</div>'

            html.push(list)
        }
    })
    return html.join('')
}

function detailIconFormatter(value, row, index) {
    return [
        '<a class="icon" href="javascript:void(0)">',
        '<i class="bi bi-plus-square"></i>',
        '</a>'
    ].join('')
}

window.detailIconEvents = {
    'click .icon': function (e, value, row, index) {
        $(e.currentTarget).find('i').toggleClass('bi-plus-square').toggleClass('bi-dash-square')
        $table.bootstrapTable('toggleDetailView', index)
    }
}