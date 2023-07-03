<?php

namespace App\Http\Controllers\API;

use App\Helper\CustomController;
use App\Models\Supplier;

class SupplierController extends CustomController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            $data = Supplier::with([])
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan server (' . $e->getMessage() . ')', 500);
        }
    }
}