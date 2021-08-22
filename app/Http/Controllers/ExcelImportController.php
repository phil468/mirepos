<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Controllers\Storage;
use Illuminate\Support\Collection;
use DB;
use Response;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ReporteCierreImport;
use App\Imports\NotaIngresoImport;

//use Excel;
use App\PDO;

class ExcelImportController extends Controller
{
    public function index(Request $request)
    {
        $mytime=Carbon::now('America/Lima');
        $month = $mytime->format('m');
        $year = $mytime->format('Y');
        $query=trim($request->get('searchText'));
        $registros=DB::table('reporte_cierre')
        ->select('No','CODIGO','DESCRIPCION','UM','CANTIDAD')
        ->where('descripcion','LIKE','%'.$query.'%')
        ->whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->orwhere('codigo','LIKE','%'.$query.'%')
        ->whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->orderBy('No','desc')
        ->paginate(10);

        return view('producto.reporte_cierre.index',["registros" =>$registros,"searchText"=>$query]); 
    }
    public function import(Request $request)
    {   
        
        $file = $request->file('archivo');
        if(empty($file))
        {
            return back()->withInput()->with('infoError',' No se pudo detectar el archivo. Asegúrese de pasar una extensión válida al nombre de archivo o pasar un tipo explícito.'); 
        }    
        else
        {
            try
            {
                $extname = ExcelImportController::after_last('.', $file->getClientOriginalName());
                if ('xlsx' == $extname || 'xls' == $extname || 'csv' == $extname || 'XLS' == $extname || 'XLSX' == $extname)
                {
                    Excel::import(new ReporteCierreImport, $file);
                    return back()->with('info','Importe realizado con exito');
                }
                else
                {
                    return back()->withInput()->with('infoError','El documento es de extensión '.$extname.'. Por favor suba en formato: xlsx, xls');
                }
                
            }
            catch(\Exception $e)
            {
                return back()->withInput()->with('infoError','Error al guardar la información , Enviar mensaje al Administrador: '.$e->getMessage());
            }
            
        }
    }
    public function indexingreso(Request $request)
    {
        $mytime=Carbon::now('America/Lima');
        $month = $mytime->format('m');
        $year = $mytime->format('Y');
        $query=trim($request->get('searchText'));
        $registros=DB::table('nota_ingreso')
        ->select('No','CODIGO','DESCRIPCION','UM','CANTIDAD')
        ->where('descripcion','LIKE','%'.$query.'%')
        ->whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->orwhere('codigo','LIKE','%'.$query.'%')
        ->whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->orderBy('No','desc')
        ->paginate(10);

        return view('producto.nota_ingreso.index',["registros" =>$registros,"searchText"=>$query]); 
    }
    
    private function after_last ($chart, $inthat)
    {
        if (!is_bool(ExcelImportController::strrevpos($inthat, $chart)))
        return substr($inthat, ExcelImportController::strrevpos($inthat, $chart)+strlen($chart));
    }
    
    private function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    }
    
}
