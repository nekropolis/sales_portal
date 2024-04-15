$(document).ready(function () {
    $(".deleteCurrency").on('click', function () {
        const currency_id = $(this).data('id');

        axios.post("/delete-currency", {currency_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });

    $(".updateCurrency").on('click', function () {
        $('#updateCurrency').modal('show');
        const currency_id = $(this).data('id');
        $(".modal-body #category_id").val(currency_id);
        const updateCurrencyModal = document.getElementById('updateCurrency');
        const name = updateCurrencyModal.querySelector('.modal-body .name');

        axios.post("/update-currency", {currency_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            name.value = data.name
        }).catch((error) => {
            console.log(error)
        });
    });
});
