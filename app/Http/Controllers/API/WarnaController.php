<?php


namespace App\Http\Controllers\API;


use App\Helper\CustomController;
use App\Models\Warna;

class WarnaController extends CustomController
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
            $q = $this->field('q');
            $data = Warna::with([])
                ->where('nama', 'LIKE', '%' . $q . '%')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }

    private function create()
    {
        $name = $this->postField('name');
        $data = [
            'nama' => $name
        ];
        Warna::create($data);
        return $this->jsonResponse('success', 200);
    }
}
