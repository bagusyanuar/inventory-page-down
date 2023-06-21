<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        DB::beginTransaction();
        try {
            if ($this->request->method() === 'POST') {
                return $this->checkout();
            }
            $data = BarangMasuk::with(['supplier', 'detail.barang.jenis_barang', 'detail.barang.bahan', 'detail.barang.warna'])
                ->orderBy('tanggal', 'DESC')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    private function checkout()
    {
        $data = [
            'supplier_id' => $this->postField('supplier'),
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'no_masuk' => 'BM-' . Carbon::now()->format('YmdHis'),
            'keterangan' => $this->postField('keterangan')
        ];
        $details = BarangMasukDetail::with([])
            ->whereNull('barang_masuk_id')
            ->get();
        if (count($details) <= 0) {
            return $this->jsonResponse('tidak ada daftar barang masuk...', 500);
        }

        $barangMasuk = BarangMasuk::create($data);
        foreach ($details as $detail) {
            $detail->update([
                'barang_masuk_id' => $barangMasuk->id
            ]);
        }
        DB::commit();
        return $this->jsonResponse('success', 200);
    }

    public function detail($id)
    {
        try {
            $data = BarangMasuk::with(['supplier', 'detail.barang.jenis_barang', 'detail.barang.bahan', 'detail.barang.warna'])
                ->where('id', '=', $id)
                ->first();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    public function cart()
    {
        try {
            if ($this->request->method() === 'POST') {
                return $this->addCart();
            }
            $data = BarangMasukDetail::with(['barang.jenis_barang', 'barang.bahan', 'barang.warna'])
                ->whereNull('barang_masuk_id')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    private function addCart()
    {
        $barang = Barang::with([])
            ->where('jenis_barang_id', '=', $this->postField('jenis_barang'))
            ->where('bahan_id', '=', $this->postField('bahan'))
            ->where('warna_id', '=', $this->postField('warna'))
            ->where('ukuran', '=', $this->postField('ukuran'))
            ->first();
        if (!$barang) {
            return $this->jsonResponse('master barang tidak ditemukan....', 404);
        }
        $data = [
            'barang_masuk_id' => null,
            'barang_id' => $barang->id,
            'qty' => (int)$this->postField('qty')
        ];
        BarangMasukDetail::create($data);
        return $this->jsonResponse('success', 200);
    }
}
