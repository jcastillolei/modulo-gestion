<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Session;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Input;
use DB;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;





class exportTransUsu implements FromCollection, WithHeadings, WithColumnFormatting, WithTitle, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transacciones = Session::get('transacciones');

        //$collection = new collect();

        $collection = collect([]);

        foreach ($transacciones as $it) {
        	
            $bod = DB::table('0_locations')
            ->where('loc_code',$it->Codigo_bodega)
            ->first();



            $itm = DB::table('0_stock_master')
            ->where('stock_id',$it->Codigo_item)
            ->first();



        	$collection->push([
        		'tipoTransaccion' => $it->tipo_transaccion,
        		'Bodega' =>  $it->Codigo_bodega,
                'Nombre Bodega' =>  $bod->location_name,
        		'Item' => $it->Codigo_item,
                'Descripcion' => $itm->description,
        		'Cantidad' =>  $it->Cantidad,
        		'Fecha' =>  $it->Fecha,
                'Usuariofinal' =>  $it->Id_UsuarioFinal
                
        	]);

        }

        return $collection;
    }

        public function headings(): array
        {
            return [
                'Tipo Transaccion',
                'Bodega',
                'Nombre Bodega',
                'Item',
                'Descripción',
                'Cantidad',
                'Fecha',
                'Usuario Solicitud'
            ];
        }

        public function title(): string
        {
            return 'Reporte transacciones';
        }

        public function columnFormats(): array
        {
            return [
                'A' => NumberFormat::FORMAT_GENERAL,
                'B' => NumberFormat::FORMAT_GENERAL,
                'C' => NumberFormat::FORMAT_GENERAL,
                'D' => NumberFormat::FORMAT_GENERAL,
                'F' => NumberFormat::FORMAT_GENERAL,
                'G' => NumberFormat::FORMAT_GENERAL,
            ];
        }
}
