function settingsPrice(price_id) {
    $('#settingsPrice').modal('show');
    $(".modal-body #price_id").val(price_id);
    $("#currency").change(function () {
        let currency_id = $('#datalistCurrency option[value="' + $('#currency').val() + '"]').data('id');
        $(".modal-body #currency_id").val(currency_id);
    });

    const settingsPriceModal = document.getElementById('settingsPrice');
    const name = settingsPriceModal.querySelector('.modal-body .name');
    const sheet_name = settingsPriceModal.querySelector('.modal-body .sheet_name');
    const numeration_started = settingsPriceModal.querySelector('.modal-body .numeration_started');
    const model_name = settingsPriceModal.querySelector('.modal-body .model_name');
    const price_name = settingsPriceModal.querySelector('.modal-body .price_name');
    const qty_name = settingsPriceModal.querySelector('.modal-body .qty_name');
    const additional = settingsPriceModal.querySelector('.modal-body .additional');
    const currency = settingsPriceModal.querySelector('.modal-body .currency');

    axios.post("/update-upload-price", {price_id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        $(".modal-body #currency_id").val(data.currency_id);
        name.value = data.name
        sheet_name.value = data.sheet_name == '[]' ? '' : data.sheet_name
        numeration_started.value = data.numeration_started == '[]' ? '' : data.numeration_started
        model_name.value = data.model_name == '[]' ? '' : data.model_name
        price_name.value = data.price_name == '[]' ? '' : data.price_name
        qty_name.value = data.qty_name == '[]' ? '' : data.qty_name
        additional.value = data.additional == '[]' ? '' : data.additional
        currency.value = data.currency.name == '[]' ? '' : data.currency.name
    }).catch((error) => {
        console.log(error)
    });
}

function parsePrice(price_id) {
    $('#modalWaitParse').modal('show');
    //const price_id = $('#price_id').val();
    axios.post("/parse-price", {price_id},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({}) => {
        $('#modalWaitParse').modal('hide');
        location.reload();
    }).catch((error) => {
        $('#modalWaitParse').modal('hide');
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

let timeout = null;
$('#search').on('keyup', function () {
    clearTimeout(timeout);
    let q = $('#search').val();
    let id = $(this).data('id');
    let count = q.trim().length;

    if (count > 2) {
        timeout = setTimeout(function () {
            axios({
                method: "get",
                url: "/price/" + id,
                params: {q: q},
                headers: {'content-type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.log(response.data);
                //location.reload();
            });
        }, 1500);
    }
});

function linkListProduct(id, model) {
    $('#linkProductCanvas').offcanvas('show');
    document.getElementById('priceModel').innerHTML = model;
    $(".offcanvas #price_model_id").val(id);

    axios({
        method: "get",
        url: "/search-product-price",
        params: {q: model},
        headers: {'content-type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
        let searchProduct = response.data;
        let linkProductName = document.getElementById("linkProductName");
        searchProduct.forEach((e) => {
            linkProductName.innerHTML +=
                `<td class="cursor-table" onclick="return addProductToLink('${id}', '${e.id}')"> ${e.brand ? e.brand.name : ''} ${e.model} <input type="text" id="searchProductId" value="${e.id}" hidden></td>`;
        });
    });
}

let linkProductCanvas = document.getElementById('linkProductCanvas')
linkProductCanvas.addEventListener('hidden.bs.offcanvas', function () {
    let table = document.getElementById("linkProductTable");
    for (let i = 1; i < table.rows.length;) {
        table.deleteRow(i);
    }
})

$(function () {
    $('td.cursor-table input[type="checkbox"]').on('click', function () {
        let param = {
            price_id: $(this).data("id"),
            checkbox: $(this).is(":checked") ? 1 : 0,
        }

        if (this.checked)
            $(this).closest("tr").addClass("table-success");
        else
            $(this).closest("tr").removeClass("table-success");

        axios.post("/is-link", {param},
            {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
            console.log(data)
        }).catch((error) => {
            console.log(error)
        });
    });
});

function addProductToLink(price_id, product_id) {
    let param = {
        price_id: parseInt(price_id),
        product_id: parseInt(product_id),
    }

    axios.post("/is-link", {param},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        console.log(data)
        $('#linkProductCanvas').offcanvas('hide');
        location.reload();
    }).catch((error) => {
        console.log(error)
    });
}

let is_sort_click = false;
function sortIsLink(price_upload_id) {
    is_sort_click = !is_sort_click;

    let param = {
        price_upload_id: price_upload_id,
        is_link_sort: is_sort_click ? 1 : 0,
    }
    axios({
        method: "get",
        url: "/price-parse/" + price_upload_id,
        params: param,
        headers: {'content-type': 'application/x-www-form-urlencoded'}
    }).then(function (response) {
        console.log(response.data);
        //location.reload();
    });
}

function getIdOfDatalist() {
    let element_input = document.getElementById('product-select');
    let element_datalist = document.getElementById('datalistOptions');
    let opSelected = element_datalist.querySelector(`[value="${element_input.value}"]`);
    let product_id = opSelected.getAttribute('data-value');
    let price_model_id = document.getElementById('price_model_id').value;

    let param = {
        price_id: parseInt(price_model_id),
        product_id: parseInt(product_id),
    }

    axios.post("/is-link", {param},
        {'content-type': 'application/x-www-form-urlencoded'}).then(({data}) => {
        console.log(data)
        $('#linkProductCanvas').offcanvas('hide');
        location.reload();
    }).catch((error) => {
        console.log(error)
    });
}