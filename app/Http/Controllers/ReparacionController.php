<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reparacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;

class ReparacionController extends Controller
{

    public function mostrarCompletos()
    {

    }

    public function vistaNuevaReparacion()
    {
        $Consolas = DB::select('SELECT * FROM producto WHERE id_tipo_producto = 1');
        $Controles = DB::select('SELECT * FROM producto WHERE id_tipo_producto = 2');
        $Audifonos = DB::select('SELECT * FROM producto WHERE id_tipo_producto = 3');
        $Accesorios = DB::select('SELECT * FROM producto WHERE id_tipo_producto = 4');

        $data = [
            'Consolas' => [$Consolas],
            'Controles' => [$Controles],
            'Audifonos' => [$Audifonos],
            'Accesorios' => [$Accesorios]
        ];

        return view('reparaciones.nuevaReparacionView', compact('data'));
    }

    public function guardarReparacion(Request $request)
    {
        $uuid = Str::uuid()->toString();
        $usuario = Auth::user();

        $reparacion = [
            'id_producto' => $request->id_producto, 'activo' => '1','correo_cliente' => $request->correo_cliente,
            'fh_inicio' => Carbon::now()->format('Y-m-d'),'status' => 'en proceso','fh_estimada' => $request->fh_estimada,
            'UUID' => $uuid, 'id_usuario' => $usuario->id, 'precio' => $request->precio
        ];
        Reparacion::insert($reparacion);
        return view('dashboard.index');
    }
}
