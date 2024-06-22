let $table = $('#tableSellers')

function ajaxRequest(params) {
    let url = '/sellers-table'

    console.log(params.data)
    $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
        console.log(res)
    })
}

function queryParams(params) {
    const parseTable = document.getElementById('tableSellers');

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
        let $modal = $('#updateSellerModal')
        let modalMarkup = $modal.html()

        $modal.html(modalMarkup).modal('show')
        const seller_id = row.id;
        $(".modal-body #seller_id").val(seller_id);
        const updateSellerModal = document.getElementById('updateSellerModal');
        const name = updateSellerModal.querySelector('.modal-body .name');

        axios.post("/update-seller", {seller_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.seller.name
        }).catch((error) => {
            console.log(error)
        });

        $(".buttonUpdateSeller").on('click', function () {
            const name = updateSellerModal.querySelector('.modal-body .name').value;

            axios.post("/update-seller", {
                    seller_id,
                    name,
                },
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                let type = data.type;
                switch (type) {
                    case "info":
                        toastr.info(data.message)
                        break;
                    case "success":
                        toastr.success(data.message)
                        $table.bootstrapTable('updateByUniqueId', {
                            id: data.seller.id,
                            row: data.seller
                        })
                        $('#updateSellerModal').modal('hide');
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
        })
    },
    'click .remove': function (e, value, row, index) {
        let retVal = confirm('Подтвердить удаление?')
        let seller_id = row.id;

        if (retVal === true) {
            axios.post("/delete-seller", {seller_id},
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

function checkIcon() {
    $table.bootstrapTable('resetSearch');
}

function formDateValueTable(value) {
    if (value !== null) {
        return new Date(value).toLocaleDateString()
    }
}
