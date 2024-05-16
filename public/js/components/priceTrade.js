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