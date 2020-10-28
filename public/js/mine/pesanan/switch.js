const form = document.querySelector('.form');
const opsi = document.querySelectorAll('.opsi');
let parn;
let jumlah;

[...opsi].map(ops => {

    ops.children[1].addEventListener('click', function () {
        let parn = (this.parentNode.parentNode);
        form.insertRow().classList.add('here')
        document.querySelector('.here').innerHTML = `
                                        <td style='width: 60%'><select name='pesanan[]' class='form-control  pesananUltra'  id=''>
                                        <option  class='here-option' value='${parn.classList[1]}'>${parn.children[1].textContent}</option>
                                            </select>
                                        </td>
                                            <td style='width: 80%'>
                                                <input type='text' class='form-control input-sm jumlah' name='jumlah[]' value='${parn.children[4].textContent}'>
                                            </td>
                                            <td style = 'width: 40%'> <span class ='trash-here btn btn-circle btn-sm btn-danger'
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
