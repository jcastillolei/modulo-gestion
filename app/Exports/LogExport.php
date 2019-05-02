<?php

namespace App\Exports;

use App\Models\log;
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

class LogExport implements FromCollection, WithHeadings, WithColumnFormatting, WithTitle, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $logs = Session::get('loger');

        if (empty($logs)) {
            $logs=DB::table('logs')->get();            
        }

        $collection = collect([]);

        foreach ($logs as $it) {
        	


        	$collection->push([
        		'usuario' => $it->usuarioLog,
        		'descripcion' =>  $it->descripcion,
        		'fecha' => $it->created_at    
        	]);

        }

        return $collection;
    }

        public function headings(): array
        {
            return [
                'Usuario',
                'Descripcion',
                'Fecha'
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
            ];
        }
}