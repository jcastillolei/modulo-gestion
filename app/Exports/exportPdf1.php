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

class exportPdf1 implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $items = Session::get('itemsBodega');

        //$collection = new collect();

        $collection = collect([]);

        foreach ($items as $it) {
        	
        	$stock = DB::table('0_stock_moves as s')
                                ->leftJoin('0_voided as b', 's.type', '=', 'b.type')
                                ->leftJoin('0_voided as c', 's.trans_no', '=', 'c.id')
                                ->whereNull('c.id')
                                ->where('stock_id',$it->stock_id)
                                ->where('tran_date','<=',date('Y-m-d'))
                                ->where('loc_code',Session::get('idBodItem'))
                                ->sum('qty');

        	$collection->push([
        		'stock_id' => $it->stock_id,
        		'loc_code' => $it->loc_code,
        		'stock' => $stock
        	]);

        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Item',
            'Bodega',
            'Stock'
        ];
    }

    public function title(): string
    {
        return 'Reporte items por bodega';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            'C' => NumberFormat::FORMAT_GENERAL,
        ];
    }
}
