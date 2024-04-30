$(document).ready(function () {
    $(".deleteProduct").on('click', function () {
        const product_id = $(this).data('id');

        axios.post("/delete-product", {product_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });

    $(".updateProduct").on('click', function () {
        $('#updateProduct').modal('show');
        const product_id = $(this).data('id');
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
            sku.value = data.sku ? data.sku : ''
            category_id.value = data.category_id
            brand_id.value = data.brand_id
            model.value = data.model
            localization.value = data.localization ? data.localization : ''
            package.value = data.package ? data.package : ''
            condition.value = data.condition ? data.condition : ''
        }).catch((error) => {
            console.log(error)
        });
    });
});
