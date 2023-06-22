@extends('cetak.index')

@section('content')
    <div class="text-center report-title">LAPORAN STOK</div>
    <div class="text-center text-body font-weight-bold">Per Tanggal {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
    <table id="my-table" class="table display" style="margin-top: 10px">
        <thead>
        <tr>
            <th width="5%" class="text-center f12 text-body-small">#</th>
            <th width="27%" class="f12 text-body-small">Jenis Barang</th>
            <th width="25%" class="f12 text-body-small">Jenis Bahan</th>
            <th width="15%" class="text-center f12 text-body-small">Warna</th>
            <th width="12%" class="text-center f12 text-body-small">Ukuran</th>
            <th width="12%"class="text-center f12 text-body-small">Jumlah</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center text-body-small">{{ $loop->index + 1 }}</td>
                <td class="text-body-small">{{ $v->jenis_barang->nama }}</td>
                <td class="text-body-small">{{ $v->bahan->nama }}</td>
                <td class="text-center text-body-small">{{ $v->warna->nama }}</td>
                <td class="text-center text-body-small">{{ $v->ukuran }}</td>
                <td class="text-center text-body-small">{{ $v->qty }}</td>
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
