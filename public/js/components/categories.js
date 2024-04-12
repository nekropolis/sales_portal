$(document).ready(function () {
    $(".deleteCategory").on('click', function () {
        const category_id = $(this).data('id');

        axios.post("/delete-category", {category_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });

    $(".updateCategory").on('click', function () {
        $('#updateCategory').modal('show');
        const category_id = $(this).data('id');
        $(".modal-body #category_id").val(category_id);
        const updateCategoryModal = document.getElementById('updateCategory');
        const name = updateCategoryModal.querySelector('.modal-body .name');

        axios.post("/update-category", {category_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.name
        }).catch((error) => {
            console.log(error)
        });
    });
});
