@extends('cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN BARANG MASUK</div>
    <div class="text-center text-body font-weight-bold">Periode {{ $tgl1 }} - {{ $tgl2 }}</div>
    <hr>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center f12 text-body-small">#</th>
            <th width="" class="text-center f12 text-body-small">Tanggal</th>
            <th width="" class="text-center f12 text-body-small">No. Masuk</th>
            <th width="" class="f12 text-body-small">Supplier</th>
            <th width="" class="f12 text-body-small">Jenis Barang</th>
            <th width="" class="text-center f12 text-body-small">Jenis Bahan</th>
            <th width="" class="text-center f12 text-body-small">Warna</th>
            <th width="" class="text-center f12 text-body-small">Ukuran</th>
            <th width="" class="text-center f12 text-body-small">Qty</th>
            <th width="" class="text-center f12 text-body-small">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-center text-body-small">{{ $v->barang_masuk->tanggal }}</td>
                <td class="text-center text-body-small">{{ $v->barang_masuk->no_masuk }}</td>
                <td class="text-body-small">{{ $v->barang_masuk->supplier->nama }}</td>
                <td class="text-body-small">{{ $v->barang->jenis_barang->nama }}</td>
                <td class="text-body-small">{{ $v->barang->bahan->nama }}</td>
                <td class="text-center text-body-small">{{ $v->barang->warna->nama }}</td>
                <td class="text-center text-body-small">{{ $v->barang->ukuran }}</td>
                <td class="text-center text-body-small">{{ $v->qty }}</td>
                <td class="text-body-small">{{ $v->barang_masuk->keterangan }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">Surakarta, {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-8 f-bold report-header-sub-title" style="text-align: right;"></div>
        <div class="col-xs-3 f-bold text-body-small" style="text-align: center;">(Admin)</div>
    </div>
@endsection
