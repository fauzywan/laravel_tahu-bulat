const bayarBanyak = document.querySelector(".bayarBanyak");
const Banyak = document.querySelector(".mVm");
const Satu = document.querySelector(".oVo");
const formMulti = document.querySelector(".form-multi");
bayarBanyak.addEventListener("change", function () {
    if (this.checked) {
        Banyak.classList.remove("hide");
        Satu.classList.add("hide");
        formMulti.classList.remove("hide");
    } else {
        if (document.querySelectorAll(".trashHide").length > 0) {
            [...document.querySelectorAll(".trashHide")].map((d) => {
                d.parentNode.parentNode.classList.remove("hide");
                d.classList.remove("trashHide");
                d.parentNode.parentNode.querySelector(".pesananH").name =
                    "pesanan[]";
                d.parentNode.parentNode.querySelector("input").name = "uang[]";
            });
        }
        Banyak.classList.add("hide");
        Satu.classList.remove("hide");
        formMulti.classList.add("hide");
    }
});
formMulti.addEventListener("click", function () {
    Banyak.submit();
});
[...document.querySelectorAll(".deLeTe")].map((DeLete) => {
    DeLete.addEventListener("click", function () {
        this.parentNode.parentNode.classList.add("hide");
        this.classList.add("trashHide");
        this.parentNode.parentNode.querySelector("input").name = "hiden";
        this.parentNode.parentNode.querySelector(".pesananH").name = "hiden";
    });
});
