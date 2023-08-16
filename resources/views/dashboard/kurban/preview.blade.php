<h1>Tahun: {{ $tahun }}</h1>
<div class="table table-responsive">
    <table class="table table-bordered">
        <thead>
            <th>
                Nama
            </th>
            <th>
                Hewan
            </th>
            <th>
                Jumlah
            </th>
            <th>
                Tanggal Masuk
            </th>
        </thead>
        <tbody>
            @foreach ($kurban as $item)
                <!-- Display Kurban data -->
                <tr>
                    <td>
                        {{ $item->nama }}
                    </td>
                    <td>
                        {{ $item->hewan_kurban }}
                    </td>
                    <td>
                        {{ $item->jumlah }}
                    </td>
                    <td>
                        {{ $item->tanggal_masuk }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{ url('download', ['tahun' => $tahun]) }}" class="btn btn-primary">
    Download PDF
</a>
