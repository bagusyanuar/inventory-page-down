@extends('layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Laporan Barang Keluar</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Barang Keluar
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-header">
                <p class="font-weight-bold mb-0">Filter Tanggal</p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center w-50">
                        <input type="date" class="form-control" name="tgl1" id="tgl1" value="{{ date('Y-m-d') }}">
                        <span class="font-weight-bold mr-2 ml-2">S/D</span>
                        <input type="date" class="form-control" name="tgl2" id="tgl2" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="text-right">
                        <a href="#" target="_blank" class="btn btn-success" id="btn-cetak">
                            <i class="fa fa-print mr-2"></i>
                            <span>Cetak</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">No. Keluar</th>
                        <th width="10%">Customer</th>
                        <th width="10%">No. Hp</th>
                        <th width="27%">Jenis Barang</th>
                        <th width="25%">Jenis Bahan</th>
                        <th width="15%">Warna</th>
                        <th width="12%">Ukuran</th>
                        <th width="12%">Qty</th>
                        <th width="12%">Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function reload() {
            table.ajax.reload();
        }

        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/laporan-barang-keluar', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'barang_keluar.tanggal'},
                {data: 'barang_keluar.no_keluar'},
                {data: 'barang_keluar.nama'},
                {data: 'barang_keluar.no_hp'},
                {data: 'barang.jenis_barang.nama'},
                {data: 'barang.bahan.nama'},
                {data: 'barang.warna.nama'},
                {data: 'barang.ukuran'},
                {data: 'qty'},
                {data: 'barang_keluar.keterangan'},
            ], [
                {
                    targets: [0, 3, 4, 5],
                    className: 'text-center'
                },
            ], function (d) {
                d.tgl1 = $('#tgl1').val();
                d.tgl2 = $('#tgl2').val();
            }, {
                "fnDrawCallback": function (setting) {
                },
                scrollX: true
            });

            $('#tgl1').on('change', function (e) {
                reload();
            });
            $('#tgl2').on('change', function (e) {
                reload();
            });
            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                let tgl1 = $('#tgl1').val();
                let tgl2 = $('#tgl2').val();
                window.open('/laporan-barang-keluar/cetak?tgl1=' + tgl1 + '&tgl2=' + tgl2, '_blank');
            })
        });
    </script>
@endsection
