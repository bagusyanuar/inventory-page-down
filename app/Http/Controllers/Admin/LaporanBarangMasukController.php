<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\BarangMasukDetail;

class LaporanBarangMasukController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = BarangMasukDetail::with(['barang_masuk.supplier', 'barang.jenis_barang', 'barang.bahan', 'barang.warna'])
                ->whereHas('barang_masuk', function ($q) use ($tgl1, $tgl2){
                    return $q->whereBetween('tanggal', [$tgl1, $tgl2]);
                })
                ->get();
            return $this->basicDataTables($data);
        }
        return view('laporan-barang-masuk.index');
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = BarangMasukDetail::with(['barang_masuk.supplier', 'barang.jenis_barang', 'barang.bahan', 'barang.warna'])
            ->whereHas('barang_masuk', function ($q) use ($tgl1, $tgl2){
                return $q->whereBetween('tanggal', [$tgl1, $tgl2]);
            })
            ->get();
        $html = view('cetak.barang-masuk')->with(['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
