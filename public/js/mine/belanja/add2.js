const minus = document.getElementById('minus')
const add = document.getElementById('add')
const remove = document.querySelectorAll('.remove')
const kotak = document.querySelector('.add');
let hasil;
add.addEventListener('click', function () {
    if (kotak.querySelector("tr") == null || hasil == undefined) {
        if (hasil == undefined) {

            fetch('/api/belanja/adder')
                .then(data => data.text())
                .then(data => {
                    hasil = data
                    if (kotak.querySelector("tr") == null) {

                        kotak.innerHTML = hasil
                    } else {
                        kotak.insertRow().classList.add('next')
                        kotak.querySelector(".next").innerHTML = hasil;
                        kotak.querySelector('.next').classList.remove('next')
                    }
                })
        } else {
            kotak.innerHTML = hasil
        }

    } else {
        if (kotak.querySelector('.next') == null) {
            kotak.insertRow().classList.add('next')
        }
        kotak.querySelector('.next').innerHTML = hasil
        kotak.querySelector('.next').classList.remove('next')
        // document.querySelector('.next').classList.remove('next')
    }
})
document.addEventListener('click', function (e) {
    if (e.target.classList[0] == "remove") {
        e.target.parentNode.remove()
    }
    if (e.target.classList[2] == "remove") {
        e.target.parentNode.parentNode.remove()
    }

})

minus.addEventListener('click', function () {

    if (kotak.querySelectorAll('tr').length > 0) {
        kotak.querySelectorAll('tr')[kotak.querySelectorAll('tr').length - 1].remove()
    }

});
