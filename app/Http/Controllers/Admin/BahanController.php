<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Bahan;
use App\Models\Barang;

class BahanController extends CustomController
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
                    'nama' => $this->postField('name')
                ];
                Bahan::create($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = Bahan::all();
            return $this->basicDataTables($data);
        }
        return view('bahan.index');
    }

    public function patch($id)
    {
        try {
            $data = Bahan::find($id);
            $data_request = [
                'nama' => $this->postField('name')
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
            Bahan::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
