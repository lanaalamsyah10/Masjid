<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Halaman Print A4</title>
</head>
<style type="text/css">
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }

    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    .garis {
        border: 1px solid #000000;
        margin-bottom: 25px;
    }

    h1 {
        font-size: 20pt;
        color: #212121;
        text-align: center;
    }

    .text {
        font-size: 12pt;
        color: #212121;
        text-align: center;
    }

    .text-right {
        font-size: 12pt;
        color: #212121;
        text-align: right;
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <h1>Laporan Pemasukan Kas MASJID AL-ISLAKH</h1>
                <p class="text">Jln. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten Indramayu, Jawa Barat 45283
                </p>
                <hr class="garis">
                <table style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>Saldo bulan April</td>
                            <th colspan="3">2000</th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Uang Masuk</td>
                            <td>Rp.1000.000</td>
                            <td>10 April 2023</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Uang Masuk</td>
                            <td>Rp.1000.000</td>
                            <td>10 April 2023</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Uang Masuk</td>
                            <td>Rp.1000.000</td>
                            <td>10 April 2023</td>
                        </tr>
                        <tr>
                            <td colspan="3">Sisa saldo :</td>
                            <th>Rp. 3.000.000.000</th>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <p> Saldo</p>
                    <p class=" text-right"> Saldo</p>
                </div>
            </div>
        </div>

        <div class="page">
            <div class="subpage">Page 2/2</div>
        </div>

    </div>
</body>

</html>
{{-- <script type="text/javascript">
    window.print();
</script> --}}
