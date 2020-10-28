const tabel = document.querySelector('.pesanan-table');
const bayarTable = tabel.querySelectorAll('.btn-credit');
const formBayar = document.querySelector('.formBayar');
const select = formBayar.querySelector('select');;
let td;
let nama;
[...bayarTable].map(bt => {
    bt.addEventListener('click', function () {
        formBayar.querySelector('button').classList.remove('hide')
        formBayar.querySelector('.batal').classList.remove('hide')
        td = this.parentNode.parentNode.children[1];
        id = td.id.split('-')[1];
        nama = td.textContent;
        select.children[0].textContent = nama;
        select.children[0].value = id;
        formBayar.setAttribute('action', `/pesanan/${id}/bayar`);

    })

})

formBayar.querySelector('.batal').addEventListener('click', function () {
    select.children[0].textContent = "";
    formBayar.setAttribute('action', '');
    formBayar.querySelector('input[type=date]').value = '0000-00-00';
    formBayar.querySelector('input[type=text]').value = '';
    select.children[0].value = "";
    this.classList.add('hide');
    formBayar.querySelector('button').classList.add('hide');

});
