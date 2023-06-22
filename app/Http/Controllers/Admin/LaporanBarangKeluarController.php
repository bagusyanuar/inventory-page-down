<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\BarangKeluarDetail;

class LaporanBarangKeluarController extends CustomController
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
            $data = BarangKeluarDetail::with(['barang_keluar', 'barang.jenis_barang', 'barang.bahan', 'barang.warna'])
                ->whereHas('barang_keluar', function ($q) use ($tgl1, $tgl2){
                    return $q->whereBetween('tanggal', [$tgl1, $tgl2]);
                })
                ->get();
            return $this->basicDataTables($data);
        }
        return view('laporan-barang-keluar.index');
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = BarangKeluarDetail::with(['barang_keluar', 'barang.jenis_barang', 'barang.bahan', 'barang.warna'])
            ->whereHas('barang_keluar', function ($q) use ($tgl1, $tgl2){
                return $q->whereBetween('tanggal', [$tgl1, $tgl2]);
            })
            ->get();
        $html = view('cetak.barang-keluar')->with(['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
