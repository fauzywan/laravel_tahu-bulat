const jenis = document.getElementById('jenis');
const disini = document.getElementById('disini');
const form = document.querySelector('.form_search');
const input = form.querySelector('.form_input');

form.addEventListener('submit', function (e) {
    e.preventDefault();
    let search;
    if (input.value == "") {
        search = "all";
    } else {
        search = input.value;
    }
    fetch(`/api/produksi/${search}/${jenis.value}`)
        .then(data => data.text())
        .then(data =>
            disini.innerHTML = data
        )
});
document.getElementById('tekanAku').addEventListener('click', function (e) {
    e.preventDefault();
    let search;
    if (input.value == "") {
        search = "all";
    } else {
        search = input.value;
    }
    fetch(`/api/produksi/${search}/${jenis.value}`)
        .then(data => data.text())
        .then(data =>
            disini.innerHTML = data
        )

});
jenis.addEventListener('change', function () {
    let search;
    if (input.value == "") {
        search = "all";
    } else {
        search = input.value;
    }
    fetch(`/api/produksi/${search}/${jenis.value}`)
        .then(data => data.text())
        .then(data =>
            disini.innerHTML = data
        )
});
