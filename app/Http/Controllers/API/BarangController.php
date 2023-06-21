<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Barang;

class BarangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            if ($this->request->method() === 'POST') {
                return $this->create();
            }
            $data = Barang::with(['jenis_barang', 'warna', 'bahan'])
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    private function create()
    {
        $data = [
            'jenis_barang_id' => $this->postField('jenis_barang'),
            'bahan_id' => $this->postField('bahan'),
            'warna_id' => $this->postField('warna'),
            'ukuran' => $this->postField('ukuran'),
        ];
        Barang::create($data);
        return $this->jsonResponse('success', 200);
    }
}
