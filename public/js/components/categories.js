$(document).ready(function () {
    $(".delete_brand").on('click', function () {
        const brand_id = $(this).data('id');

        axios.post("/delete-brand", {brand_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });

    $(".updateBrand").on('click', function () {
        $('#updateBrand').modal('show');
        const brand_id = $(this).data('id');
        $(".modal-body #brand_id").val(brand_id);
        const updateBrandModal = document.getElementById('updateBrand');
        const name = updateBrandModal.querySelector('.modal-body .name');

        axios.post("/update-brand", {brand_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.name
        }).catch((error) => {
            console.log(error)
        });
    });
});
