$(document).ready(function () {
    $(".deleteMargin").on('click', function () {
        const margin_id = $(this).data('id');

        axios.post("/delete-margin", {margin_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });

    $(".updateMargin").on('click', function () {
        $('#updateMargin').modal('show');
        const margin_id = $(this).data('id');
        $(".modal-body #margin_id").val(margin_id);
        const updateMarginModal = document.getElementById('updateMargin');
        const name = updateMarginModal.querySelector('.modal-body .name');
        const percent = updateMarginModal.querySelector('.modal-body .percent');

        axios.post("/update-margin", {margin_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.name;
            percent.value = data.percent;
        }).catch((error) => {
            console.log(error)
        });
    });
});
