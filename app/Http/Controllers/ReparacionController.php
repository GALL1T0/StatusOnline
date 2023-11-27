<?php

namespace App\Http\Controllers;

use App\Models\Productos;
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
            'id_producto' => $request->id_producto, 'activo' => '1', 'correo_cliente' => $request->correo_cliente,
            'fh_inicio' => Carbon::now()->format('Y-m-d'), 'status' => '1', 'fh_estimada' => $request->fh_estimada,
            'UUID' => $uuid, 'id_usuario' => $usuario->id, 'precio' => $request->precio
        ];
        try {
            // Intenta insertar la reparacion
            Reparacion::insert($reparacion);
            return redirect()->route('dashboard')->with('success', 'La reparacion se ha ingresado con éxito');
        } catch (\Throwable $th) {
            // manejo de errores
            $errorMessage = $th->getMessage();
            return redirect()->route('dashboard')->withErrors(['error' => "Hubo un error al crear la reparacion: $errorMessage"]);
        }
    }

    public function reparacionesPendientes(Request $request)
    {
        $reparaciones_pendientes = DB::select('
        SELECT reparacion.id as id, producto.nombre_producto as producto,correo_cliente as correo, estatus.tipo as estatus, fh_estimada as fecha_estimada FROM reparacion
        INNER JOIN producto on reparacion.id_producto = producto.id
        INNER JOIN estatus on reparacion.status = estatus.ID
        WHERE status NOT IN (?)', [7]);

        return view('reparaciones.verReparacionesPendientesView', compact('reparaciones_pendientes'));
    }

    public function updateReparacionPendiente(Request $request)
    {
        $reparacionModel = new Reparacion();
        $id = $request->id;
        $estatus = $request->status;
        $comentario = $request->comentario;
        $fecha = $request->fh_estimada;

        try {
            $reparacion = $reparacionModel->find($id);

            if (!$reparacion) {
                return redirect()->route('dashboard')->withErrors(['error' => 'No se encontró la reparación']);
            }
            if ($estatus == 7) {
                $reparacion->update([
                    'status' => $estatus,
                    'comentario' => $comentario,
                    'fh_fin' => Carbon::now()
                ]);
            }
            $reparacion->update([
                'status' => $estatus,
                'comentario' => $comentario,
                'fh_estimada' => $fecha
            ]);

            return redirect()->route('dashboard')->with('success', 'La reparacion se ha actualizado con éxito');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->route('dashboard')->withErrors(['error' => "Hubo un error al actualizar la reparacion: $errorMessage"]);
        }
    }

    public function vistaNuevoProducto()
    {
        $TipoProducto = DB::select('SELECT * FROM tipo_producto');
        return view('reparaciones.nuevoProductoView', compact('TipoProducto'));
    }

    public function guardarProducto(Request $request)
    {
        $tipo = $request->id_tipo_producto;
        $descripcion = $request->nombre_producto;
        $estimado = $request->estimado_reparacion;

        try {
            $nuevo_producto = new Productos;
            $nuevo_producto->nombre_producto = $descripcion;
            $nuevo_producto->id_tipo_producto = $tipo;
            $nuevo_producto->estimado_reparacion = $estimado;
            $nuevo_producto->save();

            return redirect()->route('dashboard')->with('success', 'El producto se ha ingresado con éxito');
        } catch (\Throwable $th) {
            // Manejo de errores
            $errorMessage = $th->getMessage();
            return redirect()->route('dashboard')->withErrors(['error' => "Hubo un error al insertar el producto: $errorMessage"]);
        }
    }


    public function consultaReparacion()
    {
        return view('reparaciones.consultaReperacionView');
    }

    public function modificarReparacion($id)
    {
        $reparacion = DB::select('SELECT id,UUID, status, fh_estimada, comentario FROM reparacion WHERE id = ?', [$id]);
        $Reparacion = json_encode($reparacion);
        // Decodificar la cadena JSON para obtener un array
        $reparacionArray = json_decode($Reparacion, true);
        // Ahora, puedes acceder a las propiedades usando corchetes

        $estatus = DB::select('SELECT * FROM estatus');
        return view('reparaciones.modificarReparacionView', compact('reparacionArray', 'estatus'));
    }
}
