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

$(document).ready(function () {
    $(".delete_price").on('click', function () {
        const price_id = $(this).data('id');

        axios.post("/delete-upload-price", {price_id},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
            location.reload();
        }).catch((error) => {
            console.log(error)
        });
    });
});
