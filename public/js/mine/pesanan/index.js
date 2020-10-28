const checkedIn = document.querySelector('.checkedIn');
const sedangDibuat = document.querySelector('.sedang_dibuat');
const buatPesanan = document.querySelector('.buat_pesanan');
const plusUltra = document.querySelectorAll('.plus-ultra');
const tabel = document.getElementById('tabel');
const tabel2 = document.getElementById('tabel2');
checkedIn.addEventListener('change', function () {
    if (this.checked) {
        [...document.querySelectorAll('.hidenin')].map(hidenin => hidenin.classList.replace('dateable', 'datenonable'))

        sedangDibuat.classList.add('hidden');
        buatPesanan.classList.remove('hidden');
        [...plusUltra].map(ultra => {

            ultra.classList.remove('hidden')
            ultra.previousElementSibling.classList.add('hidden')
            ultra.nextElementSibling.classList.add('hidden')
        });

    } else {

        [...tabel.querySelectorAll('tr.hidden')].map(tbl => tbl.classList.remove('hidden'));

        [...tabel2.querySelectorAll('.pesananUltra')].map(tbl2 => tbl2.parentNode.parentNode.remove());
        sedangDibuat.classList.remove('hidden');
        buatPesanan.classList.add('hidden');
        [...plusUltra].map(ultra => {
            ultra.classList.add('hidden')
            ultra.previousElementSibling.classList.remove('hidden')
            ultra.nextElementSibling.classList.remove('hidden')
        });
    }

});

const form = document.querySelector('.form');
const opsi = document.querySelectorAll('.opsi');
let parn;
let jumlah;

[...opsi].map(ops => {

    ops.children[1].addEventListener('click', function () {
        let parn = (this.parentNode.parentNode);
        form.insertRow().classList.add('here')
        document.querySelector('.here').innerHTML = `
        <td>
        <select name='pesanan[]' class='form-control  pesananUltra'  id=''>
        <option  class='here-option' value='${parn.classList[1]}'>${parn.children[1].textContent}</option>
        </select>
        </td>
        <td >
        <b style="font-size:15px;">${parn.children[4].textContent} Buah</b>
        <input type='hidden' class='form-control input-sm jumlah' readonly name='jumlah[]' value='${parn.children[4].textContent}'>
        </td>
                                            <td > <span class ='trash-here btn btn-circle btn-sm btn-danger'
                                            onclick = "trash()" > <i class = 'fas  fa-trash' > </i></span >
                                            </td>`

        document.querySelector('.here').classList.add(parn.id)
        document.querySelector('.here').classList.remove('here')
        parn.classList.add('hidden');
        parn.classList.replace('dateable', 'datenonable');
        if (form.querySelectorAll('tr').length > 1) {
            document.querySelector('.INISIAL').classList.remove('hidden')
        }


    });
});

function trash() {


    let table_tr;
    [...document.querySelectorAll('.trash-here')].forEach(trsh => {
        trsh.addEventListener('click', function () {
            document.getElementById(this.parentNode.parentNode.classList[0]).classList.replace('datenonable', 'dateable')
            table_tr = this.parentNode.parentNode.classList[0];
            this.parentNode.parentNode.remove();
            document.querySelector('table.data tbody #' + table_tr).classList.remove('hidden')
            if (form.querySelectorAll('tr').length == 0) {
                document.querySelector('.INISIAL').classList.add('hidden')
            }
        });
    });
}
