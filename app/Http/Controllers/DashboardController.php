<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        list($reparaciones_realizadas,$reparaciones_realizadas_1_semana,$porcentaje_reparacion_realizada) = $this->reparacionesRealizadas();
        list($reparaciones_pendientes, $reparaciones_pendientes_1_mes, $reparaciones_pendientes_mes_actual,$porcentaje_reparacion_pendiente) = $this->reparacionesPendientes();
        list($nuevos_clientes,$porcentaje_nuevos_clientes) = $this->nuevosClientes();
        list($ventas,$ventas_1_dia,$porcentaje_ventas) =  $this->ventas();

        $ReparacionesRealizadas = [$reparaciones_realizadas, $porcentaje_reparacion_realizada];
        $ReparacionesPendientes = [$reparaciones_pendientes, $porcentaje_reparacion_pendiente];
        $NuevosClientes = [$nuevos_clientes,$porcentaje_nuevos_clientes];
        $Ventas = [$ventas, $porcentaje_ventas];

        return view('dashboard.index', compact('ReparacionesRealizadas', 'ReparacionesPendientes', 'NuevosClientes', 'Ventas'));
    }

    public function reparacionesRealizadas()
    {
        $reparaciones_realizadas = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status = ?', [7])[0]->cuenta;
        $reparaciones_realizadas_1_semana = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status = ? AND fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 14 day) AND DATE_SUB(NOW(), INTERVAL 7 day);', [7])[0]->cuenta;
        $reparaciones_realizadas_semana_actual = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status = ? AND DATE(fh_inicio) BETWEEN CURDATE() - INTERVAL (DAYOFWEEK(CURDATE())+5)%7 DAY AND CURDATE() + INTERVAL (1-DAYOFWEEK(CURDATE()))%7 DAY;', [7])[0]->cuenta;
        $porcentaje_reparacion_realizada = 0; // Por defecto, por si no hay datos anteriores

        if ($reparaciones_realizadas > 0) {
            $porcentaje_reparacion_realizada = (($reparaciones_realizadas_semana_actual - $reparaciones_realizadas_1_semana) / $reparaciones_realizadas_1_semana) * 100;
        } else {
            $porcentaje_reparacion_realizada = 0;
        }

        return [$reparaciones_realizadas, $reparaciones_realizadas_1_semana, $porcentaje_reparacion_realizada];
    }


    public function reparacionesPendientes()
    {
        $reparaciones_pendientes = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status NOT IN (?)', [7])[0]->cuenta;
        $reparaciones_pendientes_1_mes = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status NOT IN (?) AND fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 64 day) AND DATE_SUB(NOW(), INTERVAL 30 day);', [7])[0]->cuenta;
        $reparaciones_pendientes_mes_actual = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status NOT IN (?) AND MONTH(fh_inicio) = MONTH(CURDATE()) AND YEAR(fh_inicio) = YEAR(CURDATE());', [7])[0]->cuenta;
        $porcentaje_reparacion_pendiente = 0;

        if ($reparaciones_pendientes_1_mes != 0) {
            $porcentaje_reparacion_pendiente = (($reparaciones_pendientes_mes_actual - $reparaciones_pendientes_1_mes) / $reparaciones_pendientes_1_mes) * 100;
        } else {
            $porcentaje_reparacion_pendiente = 0; // O cualquier valor predeterminado que desees asignar
        }

        if ($reparaciones_pendientes != null) {
            return [$reparaciones_pendientes, $reparaciones_pendientes_1_mes, $reparaciones_pendientes_mes_actual,$porcentaje_reparacion_pendiente];
        }
    }

    public function nuevosClientes()
    {
        $nuevos_clientes = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status = ? AND fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 1 day) AND NOW();',[7])[0]->cuenta;
        $nuevos_clientes_1_dia = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 2 day) AND DATE_SUB(NOW(), INTERVAL 1 day);')[0]->cuenta;
        $clientes = DB::select('SELECT COUNT(*) as cuenta FROM reparacion WHERE status = ?', [7])[0]->cuenta;
        $porcentaje_nuevos_clientes = 0;

        if($nuevos_clientes){
            $porcentaje_nuevos_clientes = (($nuevos_clientes - $nuevos_clientes_1_dia) / $nuevos_clientes_1_dia ) * 100;
        } else {
            $porcentaje_nuevos_clientes = 0;
        }

        return [$nuevos_clientes,$porcentaje_nuevos_clientes];
    }

    public function ventas()
    {
        $ventas = DB::select('SELECT SUM(precio) as cuenta FROM reparacion WHERE status = ?', [7])[0]->cuenta;
        $ventas_del_dia = DB::select('SELECT SUM(precio) as cuenta FROM reparacion WHERE status = ? AND fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 1 day) AND NOW()', [7])[0]->cuenta;
        $ventas_1_dia = DB::select('SELECT SUM(precio) as cuenta FROM reparacion WHERE status = ? AND fh_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 2 day) AND DATE_SUB(NOW(), INTERVAL 1 day)', [7])[0]->cuenta;
        $porcentaje_ventas = 0;

        if($ventas > 0){
            $porcentaje_ventas = (($ventas_del_dia - $ventas_1_dia)/$ventas_1_dia) * 100;
        } else {
            $porcentaje_ventas = 0;
        }

        return [$ventas,$ventas_1_dia,$porcentaje_ventas];
    }

}
