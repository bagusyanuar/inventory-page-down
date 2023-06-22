<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;

class LaporanStokController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Barang::with(['jenis_barang', 'warna', 'bahan'])->get();
            return $this->basicDataTables($data);
        }
        return view('laporan-stok.index');
    }

    public function cetak()
    {
        $data = Barang::with(['jenis_barang', 'warna', 'bahan'])->get();
        return $this->convertToPdf('cetak.stok', ['data' => $data]);
    }
}
