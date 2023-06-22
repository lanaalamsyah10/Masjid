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
{{-- <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script> --}}
{{-- <script src="assets/pages/sweet-alert.init.js"></script> --}}
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
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
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
    {{-- <script>
        $(function() {
            $(document).on('clik', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");

            });
        });
    </script> --}}
    {{-- <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");


                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(success) {
                    var route = $('#delete').val();
                    if (success) {
                        setTimeout(() => {
                            window.location.href = route;
                        }, 700);
                    }
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                })

            });
        });
    </script> --}}
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
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });
    </script>

    <script>
        function disableButton2(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Mengganti format angka sebelum submit
            // var inputHarga = document.getElementById('input-harga');
            // var nilaiInput = inputHarga.value.replace(/\D/g, '');
            // inputHarga.value = nilaiInput;

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
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
    $('#sa-params').click(function() {
        swal({
            title: 'Hapus data anda?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak !',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function(success) {
            var route = $('#sa-params').val();
            if (success) {
                setTimeout(() => {
                    window.location.href = route;
                }, 700);
            }
            swal(
                'Berhasil dihapus!',
                '',
                'success'
            )
        }, function(dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Dibatalkan',
                    '',
                    'error'
                )
            }
        })
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
