function settingsPrice(price_id) {
    $('#settingsPrice').modal('show');
    $(".modal-body #price_id").val(price_id);
    const settingsPriceModal = document.getElementById('settingsPrice');
    const name = settingsPriceModal.querySelector('.modal-body .name');
    const sheet_name = settingsPriceModal.querySelector('.modal-body .sheet_name');
    const numeration_started = settingsPriceModal.querySelector('.modal-body .numeration_started');
    const model_name = settingsPriceModal.querySelector('.modal-body .model_name');
    const price_name = settingsPriceModal.querySelector('.modal-body .price_name');
    const qty_name = settingsPriceModal.querySelector('.modal-body .qty_name');
    const additional = settingsPriceModal.querySelector('.modal-body .additional');

    axios.post("/update-upload-price", {price_id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        name.value = data.name
        sheet_name.value = data.sheet_name == '[]' ? '' : data.sheet_name
        numeration_started.value = data.numeration_started == '[]' ? '' : data.numeration_started
        model_name.value = data.model_name == '[]' ? '' : data.model_name
        price_name.value = data.price_name == '[]' ? '' : data.price_name
        qty_name.value = data.qty_name == '[]' ? '' : data.qty_name
        additional.value = data.additional == '[]' ? '' : data.additional
    }).catch((error) => {
        console.log(error)
    });
}

function parsePrice(price_id) {
    //const price_id = $('#price_id').val();
    axios.post("/parse-price", {price_id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
        location.reload();
    }).catch((error) => {
        console.log(error)
    });
}

function updateFile(price_id) {
    $('#updateFile').modal('show');
    const input = document.getElementById('update-file');
    const infoArea = document.getElementById('update-file-filename');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'Имя файла: ' + fileName;
    }

    $(".modal-body #price_id").val(price_id);
}

function addProduct() {
    $('#addProduct').modal('show');
}