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

let $table = $('#tableProducts')

function ajaxRequest(params) {
    let url = '/products-table'

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
        let $modal = $('#updateProduct')
        let modalMarkup = $modal.html()

        $modal.html(modalMarkup).modal('show')
        const product_id = row.id;
        $(".modal-body #product_id").val(product_id);
        const updateProductModal = document.getElementById('updateProduct');
        const sku = updateProductModal.querySelector('.modal-body .sku');
        const category_id = updateProductModal.querySelector('.modal-body .category_id');
        const brand_id = updateProductModal.querySelector('.modal-body .brand_id');
        const model = updateProductModal.querySelector('.modal-body .model');
        const localization = updateProductModal.querySelector('.modal-body .localization');
        const package = updateProductModal.querySelector('.modal-body .package');
        const condition = updateProductModal.querySelector('.modal-body .condition');

        axios.post("/update-product", {product_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            sku.value = data.product.sku ? data.product.sku : ''
            category_id.value = data.product.category_id
            brand_id.value = data.product.brand_id
            model.value = data.product.model
            localization.value = data.product.localization ? data.product.localization : ''
            package.value = data.product.package ? data.product.package : ''
            condition.value = data.product.condition ? data.product.condition : ''
        }).catch((error) => {
            console.log(error)
        });

        $(".buttonUpdateProduct").on('click', function () {
            axios.post("/update-product", {
                    product_id,
                    sku: sku.value,
                    category_id: category_id.value,
                    brand_id: brand_id.value,
                    model: model.value,
                    localization: localization.value,
                    package: package.value,
                    condition: condition.value
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
                            id: data.product.id,
                            row: data.product
                        })
                        $('#updateProduct').modal('hide');
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
        let product_id = row.id;

        if (retVal === true) {
            axios.post("/delete-product", {product_id},
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
