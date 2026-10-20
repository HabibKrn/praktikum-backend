<?php 
 
namespace App\Http\Controllers; 
 
class MahasiswaController extends Controller 
{ 
    public function show(string $nim) 
    { 
        return response()->json([ 
            'nim' => $nim, 
            'status' => 'aktif', 
        ]); 
    } 
} 