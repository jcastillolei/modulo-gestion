<!DOCTYPE html>   
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte Item Bodega</title>
    {!! Html::style('/css/pdf.css') !!}
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{!!asset('css/logo.png')!!}">
      </div>
      <h1>Reporte Item Bodega </h1>
      <div id="company" class="clearfix">
        <div>Liceo Ignacio Domeyko</div>
        <div>Juarez Larga,<br /> 760</div>
        <div>(2) 2737 3982</div>
      </div>
      <div id="project">
        <div><span>Establecimiento</span> Liceo Ignacio Domeyko</div>
        <div><span>Direccion</span> Juarez Larga,, 760</div>
        <div><span>Fecha</span> {{ date('d-m-Y') }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">Codigo Bodega</th>
            <th class="desc">Nombre Bodega</th>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td class="desc">{!! $d->loc_code !!}</td>
                    <td class="desc">
                      @php
                        $bod = DB::table('0_locations')
                            ->where('loc_code',$d->loc_code)
                            ->first();
                        echo $bod->location_name;
                      @endphp
                    </td>

                    <td class="unit">{!! $d->stock_id !!}</td>

                    <td class="desc">
                      @php
                        $itm = DB::table('0_stock_master')
                            ->where('stock_id',$d->stock_id)
                            ->first();
                        echo $itm->description;
                      @endphp
                    </td>

                    <td class="qty">@php
                            $stock = DB::table('0_stock_moves as s')
                                ->leftJoin('0_voided as b', 's.type', '=', 'b.type')
                                ->leftJoin('0_voided as c', 's.trans_no', '=', 'c.id')
                                ->whereNull('c.id')
                                ->where('stock_id',$d->stock_id)
                                ->where('tran_date','<=',date('Y-m-d'))
                                ->where('loc_code',$d->loc_code)
                                ->sum('qty'); 
                        echo $stock;
                        @endphp
                    </td>
                </tr>
            @endforeach    
        </tbody>
      </table>
    </main>
    <footer>
      Reporte generado a traves del modulo de gestion de inventario.
    </footer>
  </body>
</html>