let $table = $('#tableCategories')

function ajaxRequest(params) {
    let url = '/categories-table'

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
        let $modal = $('#updateCategory')
        let modalMarkup = $modal.html()

        $modal.html(modalMarkup).modal('show')
        const category_id = row.id;
        $(".modal-body #category_id").val(category_id);
        const updateCategoryModal = document.getElementById('updateCategory');
        const name = updateCategoryModal.querySelector('.modal-body .name');

        axios.post("/update-category", {category_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.category.name
        }).catch((error) => {
            console.log(error)
        });

        $(".buttonUpdateCategory").on('click', function () {
            const name = updateCategoryModal.querySelector('.modal-body .name').value;

            axios.post("/update-category", {
                    category_id,
                    name,
                },
                {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
                if (data.success) {
                    let success = (`<div class="alert alert-success alert-dismissible fade show">
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`)
                    $('#flash-message-response').after(success);
                }
                $table.bootstrapTable('updateByUniqueId', {
                    id: data.category.id,
                    row: data.category
                })
                $('#updateCategory').modal('hide');
            }).catch((error) => {
                console.log(error)
            });
        })
    },
    'click .remove': function (e, value, row, index) {
        let retVal = confirm('Подтвердить удаление?')
        let category_id = row.id;

        if (retVal === true) {
            axios.post("/delete-category", {category_id},
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