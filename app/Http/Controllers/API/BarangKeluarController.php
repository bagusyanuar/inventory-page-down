<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends CustomController
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
            $data = BarangKeluar::with(['detail.barang.jenis_barang', 'detail.barang.bahan', 'detail.barang.warna'])
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
            'nama' => $this->postField('nama'),
            'no_hp' => $this->postField('no_hp'),
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'no_keluar' => 'BK-' . Carbon::now()->format('YmdHis'),
            'keterangan' => $this->postField('keterangan')
        ];
        $details = BarangKeluarDetail::with(['barang'])
            ->whereNull('barang_keluar_id')
            ->get();
        if (count($details) <= 0) {
            return $this->jsonResponse('tidak ada daftar barang keluar...', 500);
        }

        $barangKeluar = BarangKeluar::create($data);
        foreach ($details as $detail) {
            $currentQty = $detail->barang->qty;
            $qtyOut = $detail->qty;
            if ($currentQty < $qtyOut) {
//                break;
                return $this->jsonResponse('stok barang tidak mencukupi...', 500);
            }
            $newQty = $currentQty - $qtyOut;
            $detail->update([
                'barang_keluar_id' => $barangKeluar->id
            ]);
            $detail->barang->update([
                'qty' => $newQty
            ]);
        }
        DB::commit();
        return $this->jsonResponse('success', 200);
    }

    public function cart()
    {
        try {
            if ($this->request->method() === 'POST') {
                return $this->addCart();
            }
            $data = BarangKeluarDetail::with(['barang.jenis_barang', 'barang.bahan', 'barang.warna'])
                ->whereNull('barang_keluar_id')
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

        $currentQty = $barang->qty;
        $qtyOut = (int) $this->postField('qty');
        if ($currentQty < $qtyOut) {
            return $this->jsonResponse('stok barang tidak mencukupi...', 500);
        }
        $data = [
            'barang_keluar_id' => null,
            'barang_id' => $barang->id,
            'qty' => $qtyOut
        ];
        BarangKeluarDetail::create($data);
        return $this->jsonResponse('success', 200);
    }
}
