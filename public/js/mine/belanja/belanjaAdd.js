const minus = document.getElementById("minus");
const add = document.getElementById("add");
const remove = document.querySelectorAll(".remove");
const kotak = document.querySelector(".add");
let hasil;
let total_input = [];
let jumlah = [];
add.addEventListener("click", function () {
    if (kotak.querySelectorAll("tr").length <= 0 || hasil == undefined) {
        if (hasil == undefined) {
            fetch("/api/belanja/add")
                .then((data) => data.text())
                .then((data) => {
                    hasil = data;
                    if (kotak.querySelector("tr") == null) {
                        kotak.innerHTML = hasil;
                    } else {
                        kotak.insertRow().classList.add("next");
                        kotak.querySelector(".next").innerHTML = hasil;
                        document
                            .querySelector(".next")
                            .classList.remove("next");
                    }
                });
        } else {
            kotak.insertRow().classList.add("next");

            document.querySelector(".next").innerHTML = hasil;
            document.querySelector(".next").classList.remove("next");
        }
    } else {
        if (kotak.querySelector(".next") == null) {
            kotak.insertRow().classList.add("next");
        }
        document.querySelector(".next").innerHTML = hasil;
        document.querySelector(".next").classList.remove("next");
        // document.querySelector('.next').classList.remove('next')
    }
});

document.addEventListener("click", function (e) {
    e.stopPropagation();
    if (e.target.classList[2] == "remove") {
        e.target.parentNode.parentNode.parentNode.remove();

        jumlah = e.target.parentNode.parentNode.parentNode.querySelector(
            ".total-input"
        ).value;

        if (document.getElementById("bayars_field").value.length > 3) {
            if (jumlah.length > 3) {
                jumlah = jumlah.split(",").join("");
            }
            jumlah =
                parseInt(
                    document
                    .getElementById("bayars_field")
                    .value.split(",")
                    .join("")
                ) - parseInt(jumlah);
        }
        if (jumlah.length > 3) {
            jumlah = jumlah.toString().match(/\d{1,3}/g);

            if (jumlah[jumlah.length - 1].length == 1) {
                jumlah =
                    jumlah.join("").substr(0, 1) +
                    "," +
                    jumlah
                    .join("")
                    .substr(1)
                    .match(/\d{1,3}/g);
            }

            if (jumlah[jumlah.length - 1].length == 2) {
                jumlah =
                    jumlah.join("").substr(0, 2) +
                    "," +
                    jumlah
                    .join("")
                    .substr(2)
                    .match(/\d{1,3}/g);
            }
            if (jumlah[jumlah.length - 1].length == 3) {
                jumlah =
                    jumlah.join("").substr(0, 3) +
                    "," +
                    jumlah
                    .join("")
                    .substr(3)
                    .match(/\d{1,3}/g);
            }
        }
        document.getElementById("bayars_field").value = jumlah;
    }

    if (e.target.classList[0] == "remove-tr") {
        jumlah = e.target.parentNode.parentNode.querySelector(".total-input")
            .value;
        e.target.parentNode.parentNode.remove();
    }

    if (e.target.classList[2] == "lunas") {
        e.target.parentNode.parentNode.parentNode.querySelector(
                ".dibayar-input"
            ).value = e.target.parentNode.parentNode.parentNode
            .querySelector(".total-input")
            .value.toString();
    }
    if (e.target.classList[0] == "lunas-tr") {
        e.target.parentNode.parentNode.querySelector(
                ".dibayar-input"
            ).value = e.target.parentNode.parentNode
            .querySelector(".total-input")
            .value.toString();
    }
});
let parent_let;
let uang;

function hs() {
    [...document.querySelectorAll(".harga-input")].map((harga) => {
        harga.addEventListener("keyup", function () {
            parent_let = this.parentNode.parentNode;
            if (
                parent_let.querySelector(".kuantitas-input").value.length > 0 ||
                this.value > 0
            ) {
                uang =
                    this.value *
                    parent_let.querySelector(".kuantitas-input").value;

                if (this.value.length > 3) {
                    uang =
                        this.value.split(",").join("") *
                        parent_let.querySelector(".kuantitas-input").value;
                }
                uang = uang
                    .toString()
                    .split(",")
                    .join("")
                    .match(/\d{1,3}/g);

                if (this.value.length > 0) {
                    if (uang.join("").length > 3) {
                        if (
                            parent_let.querySelector(".kuantitas-input").value >
                            0
                        ) {
                            if (uang[uang.length - 1].length == 1) {
                                uang =
                                    uang.join("").substr(0, 1) +
                                    "," +
                                    uang
                                    .join("")
                                    .substr(1)
                                    .match(/\d{1,3}/g);
                            }

                            if (uang[uang.length - 1].length == 2) {
                                uang =
                                    uang.join("").substr(0, 2) +
                                    "," +
                                    uang
                                    .join("")
                                    .substr(2)
                                    .match(/\d{1,3}/g);
                            }
                            if (uang[uang.length - 1].length == 3) {
                                uang =
                                    uang.join("").substr(0, 3) +
                                    "," +
                                    uang
                                    .join("")
                                    .substr(3)
                                    .match(/\d{1,3}/g);
                            }
                        }
                    }
                }
            }
            parent_let.querySelector(".total-input").value = uang;
            parent_let.querySelector(".dibayar-input").value = uang;
        });
    });
}

function qyt() {
    [...document.querySelectorAll(".kuantitas-input")].map((kuantitas) => {
        kuantitas.addEventListener("keyup", function () {
            if (
                this.parentNode.parentNode.querySelector(".total-input").value
                .length > 3
            ) {
                if (
                    parseInt(
                        this.parentNode.parentNode
                        .querySelector(".total-input")
                        .value.split(",")
                        .join("")
                    ) > 0
                ) {
                    this.parentNode.parentNode
                        .querySelector(".total-input")
                        .parentNode.parentNode.querySelector(
                            "[type=checkbox]"
                        ).checked = true;
                }
            } else {
                if (
                    this.parentNode.parentNode.querySelector(".total-input")
                    .value.length > 0
                ) {
                    if (
                        parseInt(
                            this.parentNode.parentNode.querySelector(
                                ".total-input"
                            ).value
                        ) > 0
                    ) {
                        this.parentNode.parentNode
                            .querySelector(".total-input")
                            .parentNode.parentNode.querySelector(
                                "[type=checkbox]"
                            ).checked = true;
                    } else {
                        this.parentNode.parentNode
                            .querySelector(".total-input")
                            .parentNode.parentNode.querySelector(
                                "[type=checkbox]"
                            ).checked = false;
                    }
                }
            }
            // if (parent_let.querySelector('.harga-input').value.length > 0) {

            parent_let = this.parentNode.parentNode;
            uang = this.value * parent_let.querySelector(".harga-input").value;
            uang = uang.toString();

            if (parent_let.querySelector(".harga-input").value.length > 3) {
                uang =
                    parent_let
                    .querySelector(".harga-input")
                    .value.split(",")
                    .join("") * this.value;

                uang = uang
                    .toString()
                    .split(",")
                    .join("")
                    .match(/\d{1,3}/g);

                if (uang[uang.length - 1].length == 1) {
                    uang =
                        uang.join("").substr(0, 1) +
                        "," +
                        uang
                        .join("")
                        .substr(1)
                        .match(/\d{1,3}/g);
                }

                if (uang[uang.length - 1].length == 2) {
                    uang =
                        uang.join("").substr(0, 2) +
                        "," +
                        uang
                        .join("")
                        .substr(2)
                        .match(/\d{1,3}/g);
                }
                if (uang[uang.length - 1].length == 3) {
                    uang =
                        uang.join("").substr(0, 3) +
                        "," +
                        uang
                        .join("")
                        .substr(3)
                        .match(/\d{1,3}/g);
                }

                parent_let.querySelector(".total-input").value = uang;
                parent_let.querySelector(".dibayar-input").value = uang;
            } else {
                parent_let.querySelector(".dibayar-input").value = uang;
                parent_let.querySelector(".total-input").value = uang;

                // }
            }
        });
    });
}

function rp() {
    [...document.querySelectorAll(".numberFormat")].forEach((a) => {
        a.addEventListener("keyup", function () {
            if (!this.value.match(/^[0-9]/g)) {
                this.value = "";
            } else {
                let pertiga = /\d{1,3}/g;
                let uang = this.value.split(",").join("").match(pertiga);
                if (this.value.length > 3) {
                    if (uang[uang.length - 1].length == 1) {
                        this.value =
                            uang.join("").substr(0, 1) +
                            "," +
                            uang.join("").substr(1).match(pertiga);
                    }

                    if (uang[uang.length - 1].length == 2) {
                        this.value =
                            uang.join("").substr(0, 2) +
                            "," +
                            uang.join("").substr(2).match(pertiga);
                    }
                    if (uang[uang.length - 1].length == 3) {
                        this.value =
                            uang.join("").substr(0, 3) +
                            "," +
                            uang.join("").substr(3).match(pertiga);
                    }
                }
                if (uang.join("").length <= 3) {
                    this.value = uang.join("");
                }
            }
        });
    });
}

function bayars(e) {
    [...document.querySelectorAll(".harga-input")].map((h) => {
        h.addEventListener("keyup", function () {
            jumlah_input();
        });
    });
}

// minus.addEventListener('click', function () {

//     if (kotak.querySelectorAll('tr').length > 0) {
//         kotak.querySelectorAll('tr')[kotak.querySelectorAll('tr').length - 1].remove()
//     }

// });

function jumlah_input() {
    [...document.querySelectorAll(".total-input")].forEach((a, index) => {
        if (a.value.length > 3) {
            if (parseInt(a.value.split(",").join("")) > 0) {
                if (
                    a.parentNode.parentNode.querySelector(".dibayar-input")
                    .value == a.value
                ) {
                    a.parentNode.parentNode.querySelector(
                        "[type=checkbox]"
                    ).checked = true;
                }
            }
        } else {
            if (a.value.length > 0) {
                if (parseInt(a.value) > 0) {
                    if (
                        a.parentNode.parentNode.querySelector(".dibayar-input")
                        .value == a.value
                    ) {
                        a.parentNode.parentNode.querySelector(
                            "[type=checkbox]"
                        ).checked = true;
                    }
                } else {
                    a.parentNode.parentNode.querySelector(
                        "[type=checkbox]"
                    ).checked = false;
                }
            }
        }
        if (a.value.length > 3) {
            total_input[index] = parseInt(a.value.split(",").join(""));
        } else {
            total_input[index] = parseInt(a.value);
        }
    });
    jumlah = total_input.reduce((a, b) => {
        return a + b;
    });

    if (jumlah.toString().length > 3) {
        jumlah = jumlah.toString().match(/\d{1,3}/g);

        if (jumlah[jumlah.length - 1].length == 1) {
            jumlah =
                jumlah.join("").substr(0, 1) +
                "," +
                jumlah
                .join("")
                .substr(1)
                .match(/\d{1,3}/g);
        }

        if (jumlah[jumlah.length - 1].length == 2) {
            jumlah =
                jumlah.join("").substr(0, 2) +
                "," +
                jumlah
                .join("")
                .substr(2)
                .match(/\d{1,3}/g);
        }
        if (jumlah[jumlah.length - 1].length == 3) {
            jumlah =
                jumlah.join("").substr(0, 3) +
                "," +
                jumlah
                .join("")
                .substr(3)
                .match(/\d{1,3}/g);
        }
    }

    document.getElementById("bayars_field").value = jumlah;
}

function cekbox() {
    [...document.querySelectorAll("[type=checkbox]")].map((cekbox) => {
        cekbox.addEventListener("change", function () {
            if (this.checked == true) {
                this.parentNode.parentElement
                    .querySelector(".dibayar-input")
                    .classList.add("hidden");
            } else {
                this.parentNode.parentElement
                    .querySelector(".dibayar-input")
                    .classList.remove("hidden");
            }
        });
    });
}

function dibayar_in() {
    [...document.querySelectorAll(".dibayar-input")].map((d) => {
        d.addEventListener("keyup", function () {
            if (
                this.value ==
                this.parentNode.parentNode.parentNode.querySelector(
                    ".total-input"
                ).value
            ) {
                this.classList.add("hidden");
            }
            if (
                this.parentElement.querySelector("[type=checkbox]").checked ==
                false
            ) {
                this.parentElement.querySelector(
                    "[type=checkbox]"
                ).checked = true;
            }
        });
    });
}
