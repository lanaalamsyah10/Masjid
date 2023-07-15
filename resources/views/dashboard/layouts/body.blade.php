<!-- jQuery  -->
<script src="{{ asset('db/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('db/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('db/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('db/assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('db/assets/js/detect.js') }}"></script>
<script src="{{ asset('db/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('db/assets/js/waves.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('db/assets/plugins/skycons/skycons.min.js') }}"></script>
<script src="{{ asset('db/assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('db/assets/plugins/morris/morris.min.js') }}"></script>

<script src="{{ asset('db/assets/pages/dashborad.js') }}"></script>
<!-- App js -->
<script src="{{ asset('db/assets/js/app.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#birth-date').mask('00/00/0000');
        $('#phone-number').mask('Rp 000.000.000');
    });
</script>

@push('javascript')
    <script>
        function deleteConfirmation(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus data?',
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(() => {
                        event.target.submit();

                    }, 700);
                    Swal.fire(
                        'Berhasil dihapus!',
                        'Data berhasil dihapus',
                        'success'
                    )
                }
            });
        }
    </script>
    <script>
        function disableButton(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Mengganti format angka sebelum submit
            var inputHarga = document.getElementById('input-harga');
            var nilaiInput = inputHarga.value.replace(/\D/g, '');
            inputHarga.value = nilaiInput;

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
        }
    </script>
    <script>
        function disableButton1(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Mengganti format angka sebelum submit
            var inputHarga = document.getElementById('input-harga');
            var nilaiInput = inputHarga.value.replace(/\D/g, '');
            inputHarga.value = nilaiInput;

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data berhasil diubah',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>

    <script>
        function disableButton2(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
    <script>
        function disableButton3(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data berhasil diubah',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
    <script>
        function formatRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        var inputHarga = document.getElementById('input-harga');
        inputHarga.addEventListener('input', function(e) {
            var nilaiInput = e.target.value.replace(/\D/g, '');
            var nilaiFormat = formatRupiah(nilaiInput);
            e.target.value = nilaiFormat;
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            var inputHarga = document.getElementById('input-harga');
            var nilaiInput = inputHarga.value.replace(/\D/g, '');
            inputHarga.value = nilaiInput;
        });
    </script>
@endpush

<script>
    $(document).ready(function() {
        // Mendapatkan input dengan id "input-jumlah"
        var inputJumlah = $("#input-jumlah");

        // Menambahkan event listener untuk mengformat input saat pengguna mengetik
        inputJumlah.on("input", function() {
            // Menghapus karakter selain angka dari nilai input
            var value = inputJumlah.val().replace(/[^0-9]/g, "");

            // Mengubah nilai input menjadi format angka dengan ribuan (misalnya: 1,000,000)
            inputJumlah.val(new Intl.NumberFormat().format(value));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        // #datatablePemasukan
        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            processing: true,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons({
                "color": "#fff"
            }, {
                "resizeClear": true
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    };

    // scroll

    $(document).ready(function() {

        $("#boxscroll").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });
        $("#boxscroll2").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });

    });
</script>
