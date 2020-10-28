const total = document.querySelectorAll(".total_btn");
const add = document.getElementById("add");
const next = document.querySelector(".add");
let total_input;
let aray = [];
let okane;

[...total].map(a=>{
    a.addEventListener("click", function () {
    // document.querySelectorAll('.hiddem').forEach((e) => {
    //     if (e.classList[0] == 'hidden') {

    //         e.classList.remove('hidden')
    //     }
    // });
    [...document.querySelectorAll(".total-input")].forEach((a, b) => {
        if (a.value.length > 3) {
            aray[b] = parseInt(a.value.split(",").join(""));
        } else {
            aray[b] = parseInt(a.value);
        }
    });

    okane = aray.reduce((a, b) => {
        return a + b;
    });
    okane = Rupiah(okane.toString());
    document.getElementById("bayars_field").value = okane;
    aray = [];
    //Dibayar
    [...document.querySelectorAll(".dibayar-input")].forEach((a, b) => {
        if (a.value.length > 3) {
            aray[b] = parseInt(a.value.split(",").join(""));
        } else {
            aray[b] = parseInt(a.value);
        }
    });
    okane = aray.reduce((a, b) => {
        return a + b;
    });
    okane = Rupiah(okane.toString());
    document.getElementById("dibayar_field").value = okane;
    //Hutang
    if (document.getElementById("bayars_field").value.length > 3) {

        okane = document.getElementById("bayars_field").value.split(',').join('');
    } else {
        okane = document.getElementById("bayars_field").value;

    }
    if (document.getElementById("dibayar_field").value.length > 3) {
        okane = okane - document.getElementById("dibayar_field").value.split(',').join('')
    } else {
        okane = okane - document.getElementById("dibayar_field").value

    }
    okane = Rupiah(okane.toString())

    document.getElementById("hutang_field").value = okane;

});
let el;
add.addEventListener("click", function () {
    if (el == undefined) {
        fetch(`/api/belanja/add`)
            .then((data) => data.text())
            .then((data) => {
                el = data;
                if (el != undefined) {
                    next.insertRow().classList.add("next");
                    next.querySelector(".next").innerHTML = el;
                    next.querySelector(".next").querySelector('.select').classList.add(`selek-${document.querySelectorAll('.select').length+1}`)
                    next.querySelector(".next").querySelector('.select').setAttribute('onchange', "cange('selek-" +
                        (document.querySelectorAll('.select').length + 1) +
                        "')")
                    document.querySelector(".next").classList.remove("next");
                }
            });
    } else {
        next.insertRow().classList.add("next");
        next.querySelector(".next").innerHTML = el;
        next.querySelector(".next").querySelector('.select').classList.add(`selek-${document.querySelectorAll('.select').length+1}`)
        next.querySelector(".next").querySelector('.select').setAttribute('onchange', "cange('selek-" +
            (document.querySelectorAll('.select').length + 1) +
            "')")
        document.querySelector(".next").classList.remove("next");
    }
});
document.addEventListener("click", function (e) {
    if (e.target.classList[2] == "remove") {
        e.target.parentNode.parentNode.parentNode.remove();
    }
    if (e.target.classList[0] == "remove-tr") {
        jumlah = e.target.parentNode.parentNode.querySelector(".total-input")
            .value;
        e.target.parentNode.parentNode.remove();
    }
    if (e.target.classList[0] == "cekbox") {
        if (e.target.parentNode.parentNode.children[0].value.length > 0) {
            if (
                e.target.parentNode.parentNode.children[0].value != 0

            ) {


                if (e.target.checked == true) {

                    if (e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.dibayar-input').value != e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.total-input').value) {
                        e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.dibayar-input').value = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('.total-input').value
                    }
                    e.target.parentNode.parentNode.children[0].classList.add('hidden')

                } else {
                    e.target.parentNode.parentNode.children[0].classList.remove('hidden')
                }
            }
        }
    }

});
})

function Rupiah(rp) {
    if (rp.length > 3) {
        rp = rp.match(/\d{1,3}/g);

        if (rp[rp.length - 1].length == 1) {
            rp =
                rp.join("").substr(0, 1) +
                "," +
                rp
                .join("")
                .substr(1)
                .match(/\d{1,3}/g);
        }

        if (rp[rp.length - 1].length == 2) {
            rp =
                rp.join("").substr(0, 2) +
                "," +
                rp
                .join("")
                .substr(2)
                .match(/\d{1,3}/g);
        }
        if (rp[rp.length - 1].length == 3) {
            rp =
                rp.join("").substr(0, 3) +
                "," +
                rp
                .join("")
                .substr(3)
                .match(/\d{1,3}/g);
        }
    }
    return rp;
}

function qyt() {
    [...document.querySelectorAll(".kuantitas-input")].map((kuantitas) => {
        kuantitas.addEventListener("keyup", function () {
            if (
                this.parentNode.parentNode.querySelector(".harga-input").value
                .length > 0
            ) {
                if (
                    this.parentNode.parentNode.querySelector(".harga-input")
                    .value.length > 3
                ) {
                    okane =
                        parseInt(
                            this.parentNode.parentNode
                            .querySelector(".harga-input")
                            .value.split(",")
                            .join("")
                        ) * parseInt(this.value);
                    okane = Rupiah(okane.toString());
                } else {
                    okane =
                        parseInt(
                            this.parentNode.parentNode.querySelector(
                                ".harga-input"
                            ).value
                        ) * parseInt(this.value);
                    okane = Rupiah(okane.toString());
                }
            } else {
                okane = 0;
            }
            if (this.value.length == 0) {
                okane = 0;
            }

            if (okane != 0) {
                if (this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList[this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.length - 1] != 'hidden') {

                    this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.add('hidden')
                }
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = true;

            } else {
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = false;

            }
            this.parentNode.parentNode.querySelector(
                ".dibayar-input"
            ).value = okane;
            this.parentNode.parentNode.querySelector(
                ".total-input"
            ).value = okane;
        });
    });
}

function rp() {
    [...document.querySelectorAll(".numberFormat")].forEach((a) => {
        a.addEventListener("keyup", function () {
            if (a.value.length > 3) {
                a.value = Rupiah(a.value.split(",").join(""));
            } else {
                a.value = Rupiah(a.value);
            }
        });
    });
}

function hg() {
    [...document.querySelectorAll(".harga-input")].map((h) => {
        h.addEventListener("keyup", function () {
            if (
                this.parentNode.parentNode.querySelector(".kuantitas-input")
                .value.length > 0
            ) {
                if (h.value.length > 3) {
                    okane =
                        h.value.split(",").join("") *
                        this.parentNode.parentNode.querySelector(
                            ".kuantitas-input"
                        ).value;
                    okane = Rupiah(okane.toString());
                } else {
                    okane = Rupiah(
                        (
                            this.value *
                            this.parentNode.parentNode.querySelector(
                                ".kuantitas-input"
                            ).value
                        ).toString()
                    );
                }

            } else {

                okane = 0;
            }
            if (okane != 0) {
                if (this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList[this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.length - 1] != 'hidden') {

                    this.parentNode.parentNode.querySelector(
                        ".dibayar-input"
                    ).classList.add('hidden')
                }
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = true;

            } else {
                this.parentNode.parentNode.querySelector(
                    "[type=checkbox]"
                ).checked = false;

            }
            this.parentNode.parentNode.querySelector(
                ".dibayar-input"
            ).value = okane;
            this.parentNode.parentNode.querySelector(
                ".total-input"
            ).value = okane;
        });
    });
}

function cekbox() {

}
