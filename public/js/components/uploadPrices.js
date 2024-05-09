const input = document.getElementById('file-upload');
const infoArea = document.getElementById('file-upload-filename');

if (input) {
    input.addEventListener('change', showFileName);
}

function showFileName(event) {
    const input = event.srcElement;
    const fileName = input.files[0].name;
    infoArea.textContent = 'Имя файла: ' + fileName;
}

let $table = $('#tableUploadPrices')

function ajaxRequest(params) {
    let url = '/upload-price-table'

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
    if ($('#table').bootstrapTable('getOptions').sortOrder === 'desc') {
        res.rows = res.rows.reverse()
    }
    return res
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

$(function () {
    $table.on('click-row.bs.table.data-field="name"', function (e, row, $element, value) {
        if (value === 'name') {
            window.location = '/price-parse/' + row.id;
        }
    })
})

function cellStyle(value, row, index) {

    return {
        css: {
            cursor: 'pointer'
        }
    }
}

function operateFormatter(value, row, index) {
    return [
        '<a class="remove text-danger" href="javascript:void(0)" title="Remove">',
        '<i class="bi bi-trash3"></i>',
        '</a>'
    ].join('')
}

window.operateEvents = {
/*    'click .like': function (e, value, row, index) {
        alert('You click like action, row: ' + JSON.stringify(row))
    },*/
    'click .remove': function (e, value, row, index) {
        let retVal = confirm('Подтвердить удаление?')
        let price_id = row.id;

        if (retVal === true) {
            axios.post("/delete-upload-price", {price_id},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }).catch((error) => {
                console.log(error)
            });
        } else {
            e.preventDefault();
        }
    }
}