const input = document.getElementById('file-upload');
const infoArea = document.getElementById('file-upload-filename');

if (input) {
    input.addEventListener('change', showFileName);
}

function showFileName(event) {
    const input = event.srcElement;
    const fileName = input.files[0].name;
    infoArea.textContent = 'Имя файла: ' + fileName;
}

$(document).ready(function (e) {
    $(".delete_price").on('click', function () {
        let retVal = confirm('Подтвердить удаление?')
        const price_id = $(this).data('id');

        if (retVal === true) {
            axios.post("/delete-upload-price", {price_id},
                {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
                location.reload();
            }).catch((error) => {
                console.log(error)
            });
        } else {
           e.preventDefault();
        }
    });
});

$(function () {
    $('td.active-price input[type="checkbox"]').on('click', function () {
        let param = {
            price_id: $(this).data("id"),
            checkbox: $(this).is(":checked") ? 1 : 0,
        }

        if (this.checked)
            $(this).closest("tr").addClass("table-success");
        else
            $(this).closest("tr").removeClass("table-success");

        axios.post("/is_active", {param},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
        }).catch((error) => {
            console.log(error)
        });
    });
});
