let $table = $('#tableLocalizations')

function ajaxRequest(params) {
    let url = '/localizations-table'

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
        let $modal = $('#updateLocalization')
        let modalMarkup = $modal.html()

        $modal.html(modalMarkup).modal('show')
        const localization_id = row.id;
        $(".modal-body #localization_id").val(localization_id);
        const updateLocalizationModal = document.getElementById('updateLocalization');
        const name = updateLocalizationModal.querySelector('.modal-body .name');

        axios.post("/update-localization", {localization_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.localization.name
        }).catch((error) => {
            console.log(error)
        });

        $(".buttonUpdateLocalization").on('click', function () {
            const name = updateLocalizationModal.querySelector('.modal-body .name').value;

            axios.post("/update-localization", {
                    localization_id,
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
                            id: data.localization.id,
                            row: data.localization
                        })
                        $('#updateLocalization').modal('hide');
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
        let localization_id = row.id;

        if (retVal === true) {
            axios.post("/delete-localization", {localization_id},
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