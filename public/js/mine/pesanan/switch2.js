const form = document.querySelector('.form');
const opsi = document.querySelectorAll('.activein .opsi');
let parn;
let jumlah;

[...opsi].map(ops => {
    ops.querySelector('.adder').addEventListener('click', function () {
        let parn = (this.parentNode.parentNode);
        form.insertRow().classList.add('here')
        document.querySelector('.here').innerHTML = `
                                        <td style='width: 60%'><select name='pesanan[]' class='form-control  pesananUltra'  id=''>
                                        <option  class='here-option' value='${parn.classList[1]}'>${parn.children[1].textContent}</option>
                                            </select>
                                        </td>
                                            <td style='width: 80%'>
                                         
                                                <input type='text' class='form-control input-sm jumlah numberFormat' name='uang[]' value='${parn.children[4].textContent.substr(3)}' onclick="rp()">
                                            </td>
                                            <td style = 'width: 40%'> <span class ='trash-here btn btn-circle btn-sm btn-danger'
                                            onclick = "trash()" > <i class = 'fas  fa-trash' > </i></span >
                                            </td>`

        document.querySelector('.here').classList.add(parn.id)
        document.querySelector('.here').classList.remove('here')
        parn.classList.add('hidden');
        parn.classList.replace('dateable', 'datenonable');



    });
});
