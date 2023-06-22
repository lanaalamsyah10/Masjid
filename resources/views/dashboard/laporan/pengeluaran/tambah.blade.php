@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Pengeluaran</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.laporan-pengeluaran.store') }}"method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            @if ($errors->any())
                                <div class="mb-3">
                                    <div class="bg-danger px-4 py-2 text-white font-weight-bold">
                                        There's something wrong!
                                    </div>
                                    <div class="bg-danger text-white">
                                        <p>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label>Kategori Pemasukan</label>
                            <select name="pemasukan_id" id="pemasukan_id" class="form-select" required>
                                <option value="" selected style="display: none;"></option>
                                @foreach ($pemasukanKas as $item)
                                    <option value="{{ $item->id }}">{{ $item->keterangan_pemasukan }}</option>
                                @endforeach
                            </select>
                            @error('pemasukan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label>Keterangan</label>
                            <div>
                                <input type="text"
                                    class="form-control @error('keterangan_pengeluaran') is-invalid @enderror"
                                    id="keterangan_pengeluaran" name="keterangan_pengeluaran"required autofocus
                                    value="{{ old('keterangan_pengeluaran') }}" placeholder="Infaq Jamaah" />
                                @error('keterangan_pengeluaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pengeluaran</label>
                                <input type="text" class="form-control input-harga" name="jumlah_pengeluaran"
                                    id="input-harga" value="{{ old('jumlah_pengeluaran') }}" placeholder="Jumlah">
                                @error('jumlah_pengeluaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal_pengeluaran"
                                        id="tanggal_pengeluaran">
                                    @error('tanggal_pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                onclick="disableButton(this);">
                                                <span id="buttonText">Simpan</span>
                                            </button>

                                            <a href="javascript:window.history.go(-1)"
                                                class="btn btn-secondary waves-effect m-l-5">
                                                Batal
                                            </a>
                                        </div>
                                    </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->


    @push('javascript')
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
@endsection
