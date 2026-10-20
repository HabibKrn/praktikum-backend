<?php
namespace App\Http\Controllers;

use App\Services\KatalogService;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function __construct(
        private KatalogService $katalogService
    ) {}

    public function index()
    {
        return response()->json([
            'data' => $this->katalogService->all(),
        ]);
    }

    public function show(string $kode)
    {
        $katalog = $this->katalogService->find($kode);

        if (!$katalog) {
            return response()->json(['message' => 'Mata kuliah tidak ditemukan'], 404);
        }

        return response()->json([
            'data' => $katalog,
        ]);
    }
}