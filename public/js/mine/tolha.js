const kuantitas = document.querySelector(".kuantitas-input");
const harga = document.querySelector(".harga-input");
const total = document.querySelector(".total-input");
const akomodasi = document.querySelector(".akomodasi-input");
let uang;
let pertiga = /\d{1,3}/g;
let akomondasi;
akomodasi.addEventListener('keyup', function () {
    akomondasi = this.value;
    if (this.value.length > 3) {
        akomondasi = this.value.split(',').join('')
    } else if (akomodasi.value.length == 0) {
        akomondasi = 0;
    }

    if (harga.value.length > 0 && kuantitas.value.length > 0) {
        uang = parseInt(harga.value) * parseInt(kuantitas.value);
        if (parseInt(harga.value) > 0) {

            if (harga.value.length > 3) {
                uang = parseInt(harga.value.split(',').join('')) * parseInt(kuantitas.value);
            }
            uang = (uang + parseInt(akomondasi)).toString().match(pertiga);

            if (harga.value.length > 3) {

            }
            if (uang[uang.length - 1].length == 1) {

                total.value =
                    uang.join("").substr(0, 1) +
                    "," +
                    uang.join("").substr(1).match(pertiga);
            }

            if (uang[uang.length - 1].length == 2) {
                total.value =
                    uang.join("").substr(0, 2) +
                    "," +
                    uang.join("").substr(2).match(pertiga);
            }
            if (uang[uang.length - 1].length == 3) {
                uang =
                    uang.join("").substr(0, 3) +
                    "," +
                    uang.join("").substr(3).match(pertiga);

                if (uang.split(',')[1] == 'null') {
                    uang = parseInt(uang)
                }
                total.value = uang
            }
        }
    }


});
let Harga;
kuantitas.addEventListener("keyup", function () {
    if (this.value.length > 0) {
        if (harga.value.length > 0) {
            Harga = harga.value;
            if (harga.value.length > 3) {
                Harga = harga.value.split(',').join('')

            }
            uang = parseInt(Harga) * parseInt(this.value);
            if (akomodasi.value.length > 0) {
                akomondasi = akomodasi.value;
                if (akomodasi.value.length > 3) {
                    akomondasi = akomodasi.value.split(',').join('')
                }
                uang += parseInt(akomondasi);
                uang = uang.toString().match(pertiga)
                if (uang.join('').length > 3) {
                    if (uang[uang.length - 1].length == 1) {
                        total.value =
                            uang.join("").substr(0, 1) +
                            "," +
                            uang.join("").substr(1).match(pertiga);
                    }

                    if (uang[uang.length - 1].length == 2) {
                        total.value =
                            uang.join("").substr(0, 2) +
                            "," +
                            uang.join("").substr(2).match(pertiga);
                    }
                    if (uang[uang.length - 1].length == 3) {
                        total.value =
                            uang.join("").substr(0, 3) +
                            "," +
                            uang.join("").substr(3).match(pertiga);
                    }

                } else {
                    total.value =
                        uang.join("")

                }
            }

        }
    } else {
        if (akomodasi.value.length > 0) {
            total.value = parseInt(akomodasi.value);
        } else {

            total.value = 0;
        }
    }
});
harga.addEventListener("keyup", function () {
    if (this.value.length > 0) {
        Harga = parseInt(this.value);
        if (this.value.length > 3) {
            Harga = parseInt(harga.value.split(',').join(''));
        }
        if (kuantitas.value.length > 0) {
            uang = Harga * parseInt(kuantitas.value);
        } else {
            uang = Harga * 0;
        }
        if (akomodasi.value.length > 0) {
            akomondasi = akomodasi.value;
            if (akomodasi.value.length > 3) {
                akomondasi = akomodasi.value.split(',').join('');
            }
            uang += parseInt(akomondasi)
            uang = uang.toString().match(pertiga);
            if (uang[uang.length - 1].length == 1) {
                total.value =
                    uang.join("").substr(0, 1) +
                    "," +
                    uang.join("").substr(1).match(pertiga);
            }

            if (uang[uang.length - 1].length == 2) {
                total.value =
                    uang.join("").substr(0, 2) +
                    "," +
                    uang.join("").substr(2).match(pertiga);
            }
            if (uang[uang.length - 1].length == 3) {
                total.value =
                    uang.join("").substr(0, 3) +
                    "," +
                    uang.join("").substr(3).match(pertiga);
            }
        }


    } else {
        if (akomodasi.value.length > 0) {
            total.value = akomodasi.value;
        } else {
            total.value = 0
        }
    }
    // if (kuantitas.value > 0) {
    //     satuan = this.value;

    //     if (this.value.length > 3) {
    //         satuan = this.value.split(",").join("");
    //     }
    //     kali = satuan * kuantitas.value;
    //     uang = kali.toString().match(pertiga);
    //     if (this.value.length > 3) {
    //         if (uang[uang.length - 1].length == 1) {
    //             total.value =
    //                 uang.join("").substr(0, 1) +
    //                 "," +
    //                 uang.join("").substr(1).match(pertiga);
    //         }

    //         if (uang[uang.length - 1].length == 2) {
    //             total.value =
    //                 uang.join("").substr(0, 2) +
    //                 "," +
    //                 uang.join("").substr(2).match(pertiga);
    //         }
    //         if (uang[uang.length - 1].length == 3) {
    //             total.value =
    //                 uang.join("").substr(0, 3) +
    //                 "," +
    //                 uang.join("").substr(3).match(pertiga);
    //         }
    //     } else {
    //         total.value = kali;
    //     }
    // }
});
