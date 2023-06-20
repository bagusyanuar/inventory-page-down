<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Warna;

class BarangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data_request = [
                    'jenis_barang_id' => $this->postField('jenis_barang'),
                    'warna_id' => $this->postField('warna'),
                    'nama' => $this->postField('nama'),
                    'ukuran' => $this->postField('ukuran'),
                ];
                Barang::create($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Barang::with(['jenis_barang', 'warna']);
            return $this->basicDataTables($data);
        }
        $jenis_barang = JenisBarang::all();
        $warna = Warna::all();
        return view('barang.index')->with([
            'jenis_barang' => $jenis_barang,
            'warna' => $warna,
        ]);
    }

    public function patch($id)
    {
        try {
            $data = Barang::find($id);
            $data_request = [
                'jenis_barang_id' => $this->postField('jenis_barang'),
                'warna_id' => $this->postField('warna'),
                'nama' => $this->postField('nama'),
                'ukuran' => $this->postField('ukuran'),
            ];
            $data->update($data_request);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            Barang::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
