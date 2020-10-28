if ($('.hadir').length > 0) {

    $('.hadir').change(function () {

        if (this.checked == true) {
            this.parentNode.parentNode.querySelector('select').setAttribute('name', 'karyawan[]')
            this.classList.replace('not_active', 'active', )
        } else {
            this.classList.replace('active', 'not_active', )

            this.parentNode.parentNode.querySelector('.selek').removeAttribute('name')
        }
    });
    document.querySelector('.semua').addEventListener('click', function (e) {

        cekboxAll()
    })


    document.addEventListener('keyup', function (e) {
        if (e.key == "A" && e.shiftKey) {
            cekboxAll()
        }
        if (e.key == "Enter") {
            document.querySelector('.form-submit').submit()
        }
    })

    function cekboxAll() {
        if (document.querySelectorAll('.not_active').length == 0) {

            [...document.querySelectorAll('.hadir')].map(a => {
                a.checked = false
                a.classList.replace('active', 'not_active')
                a.parentNode.parentNode.querySelector('select').setAttribute('name', '')


            })
        } else {

            [...document.querySelectorAll('.hadir')].map(a => {
                if (a.checked == false) {
                    a.checked = true
                    a.classList.replace('not_active', 'active', )
                    a.parentNode.parentNode.querySelector('select').setAttribute('name', 'karyawan[]')


                }
            })
        }
    }
}
