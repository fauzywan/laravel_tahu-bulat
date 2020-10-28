function qyt() {
    let uang;
    let pertiga = /\d{1,3}/g;
    let harga;
    let money;
    let idr;
    const kuantitas = document.querySelectorAll('.kuantitas-input');
    kuantitas.forEach(qyt => {
        qyt.addEventListener("keyup", function () {
            harga = this.parentNode.parentNode.querySelector('.harga-input');
            total = this.parentNode.parentNode.querySelector('.total-input');
            if (harga.value.length > 0) {
                if (harga.value.length > 3) {
                    uang = parseInt(harga.value.split(",").join("")) * this.value;
                    uang = uang.toString().match(pertiga);
                    if (uang[uang.length - 1].length == 1) {
                        uang = uang.join("")
                        total.value = `${uang.substr(0, 1)},${uang.substr(1)}`;
                    }
                    if (uang[uang.length - 1].length == 2) {
                        uang = uang.join("")
                        total.value = `${uang.substr(0, 2)},${uang.substr(2)}`;
                    }
                    if (uang[uang.length - 1].length == 3) {
                        uang = uang.join("")
                        total.value = `${uang.substr(0, 3)},${uang.substr(3)}`;
                    }
                } else {
                    money = this.value * harga.value;
                    idr = (money).toString().split(',').join('').match(pertiga);
                    if (this.value * harga.value.length > 3) {

                        if (idr[idr.length - 1].length == 1) {
                            total.value = idr.join('').substr(0, 1) + "," + idr.join('').substr(1).match(pertiga);
                        }

                        if (idr[idr.length - 1].length == 2) {
                            total.value = idr.join('').substr(0, 2) + "," + idr.join('').substr(2).match(pertiga);


                        }
                        if (idr[idr.length - 1].length == 3) {
                            total.value = idr.join('').substr(0, 3) + "," + idr.join('').substr(3).match(pertiga);

                        }
                    }
                    if (idr.join('').length <= 3) {
                        total.value = idr.join('');
                    }


                    // total.value=
                }
            }
        });
    });

}

function hs() {
    let uang;
    let pertiga = /\d{1,3}/g;
    let harga, satuan, kuantitas, total;
    harga = document.querySelectorAll('.harga-input');
    harga.forEach(h => {
        h.addEventListener("keyup", function () {
            kuantitas = this.parentNode.parentNode.querySelector('.kuantitas-input');
            total = this.parentNode.parentNode.querySelector('.total-input');
            if (kuantitas.value > 0) {
                satuan = this.value;
                if (this.value.length > 3) {
                    satuan = this.value.split(",").join("");
                }
                kali = satuan * kuantitas.value;
                uang = kali.toString().match(pertiga);
                if (this.value.length > 3) {
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
                    total.value = satuan * kuantitas.value;
                }
            }

        });
    })

}

function rp() {
    let number = document.querySelectorAll('.numberFormat');
    number.forEach(n => {

        n.addEventListener('keyup', function () {
            if (!this.value.match(/^[0-9]/g)) {
                this.value = "";
            } else {

                let pertiga = /\d{1,3}/g;
                var money = this.value.split(',').join('').match(pertiga);
                if (this.value.length > 3) {

                    if (money[money.length - 1].length == 1) {
                        this.value = money.join('').substr(0, 1) + "," + money.join('').substr(1).match(pertiga);
                    }

                    if (money[money.length - 1].length == 2) {
                        this.value = money.join('').substr(0, 2) + "," + money.join('').substr(2).match(pertiga);


                    }
                    if (money[money.length - 1].length == 3) {
                        this.value = money.join('').substr(0, 3) + "," + money.join('').substr(3).match(pertiga);

                    }
                }
                if (money.join('').length <= 3) {
                    this.value = money.join('');
                }

            }


        });
    });


}
