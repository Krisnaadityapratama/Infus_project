<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\sensor;
use Illuminate\Http\Request;

class pasiensController extends Controller
{
    public function list(){
        $pasien = Pasien::all();
        return view('listPasiens', ['key' => $pasien]);
    }

    public function delete($id){
        $pasien = Pasien::where('id', $id)->first();
        $pasien->delete();
        return redirect()->route('pasiens');
    }

    public function edit($id){
        $alat = sensor::all(); 
        $pasien = Pasien::findOrFail($id);
        return view('editPasien', [
            'pasien' => $pasien, 
            'alat' => $alat]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $pasien = Pasien::find($id);
        $pasien->nama = $request->nama;
        $pasien->ruang = $request->ruang;
        $pasien->tetes = $request->tetes;
        $pasien->alat = $request->alat;
        $pasien->save();

    
        return redirect()->route('pasiens')->with('message', 'Data pasien berhasil diperbarui.');
    }

    public function getDropRate($idAlat) {
        $pasien = Pasien::where('alat', $idAlat)->first();
        if ($pasien) {
            return response()->json(['drop_rate' => $pasien->tetes]);
        }
        return response()->json(['error' => 'Pasien not found'], 404);
    }
}
