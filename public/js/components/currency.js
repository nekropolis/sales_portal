let $table = $('#tableCurrency')

function ajaxRequest(params) {
    let url = '/currency-table'

    console.log(params.data)
    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
        console.log(res)
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

function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="Edit">',
        '<i class="bi bi-pencil-square"></i>',
        '</a>  ',
        '<a class="remove text-danger" href="javascript:void(0)" title="Remove">',
        '<i class="bi bi-trash3"></i>',
        '</a>'
    ].join('')
}

window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        let $modal = $('#updateCurrency')
        let modalMarkup = $modal.html()

        $modal.html(modalMarkup).modal('show')
        const currency_id = row.id;
        $(".modal-body #currency_id").val(currency_id);
        const updateCurrencyModal = document.getElementById('updateCurrency');
        const name = updateCurrencyModal.querySelector('.modal-body .name');
        const code = updateCurrencyModal.querySelector('.modal-body .code');

        axios.post("/update-currency", {currency_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.currency.name;
            code.value = data.currency.code;
        }).catch((error) => {
            console.log(error)
        });

        $(".buttonUpdateCurrency").on('click', function () {
            const name = updateCurrencyModal.querySelector('.modal-body .name').value;
            const code = updateCurrencyModal.querySelector('.modal-body .code').value;

            axios.post("/update-currency", {
                    currency_id,
                    name,
                    code
                },
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                if (data.success) {
                    toastr.success(data.message)
                }
                $table.bootstrapTable('updateByUniqueId', {
                    id: data.currency.id,
                    row: data.currency
                })
                $('#updateCurrency').modal('hide');
            }).catch((error) => {
                console.log(error)
            });
        })
    },
    'click .remove': function (e, value, row, index) {
        let retVal = confirm('Подтвердить удаление?')
        let currency_id = row.id;

        if (retVal === true) {
            axios.post("/delete-currency", {currency_id},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
                location.reload();
            }).catch((error) => {
                console.log(error)
            });
        } else {
            e.preventDefault();
        }
    }
}

function checkIcon() {
    $table.bootstrapTable('resetSearch');
}

function formDateValueTable(value) {
    if (value !== null) {
        return new Date(value).toLocaleDateString()
    }
}