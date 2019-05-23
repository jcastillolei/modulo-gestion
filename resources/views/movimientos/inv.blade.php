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
      <h1>{{ $acc }} Item</h1>
      <br>
      <br>
      <div id="company" class="clearfix">
        <div>Liceo Ignacio Domeyko</div>
        <div>Juarez Larga,<br /> 760</div>
        <div>(2) 2737 3982</div>
      </div>
      <div id="project">
        <div><span>Establecimiento</span> Liceo Ignacio Domeyko</div>
        <div><span>Direccion</span> Juarez Larga, 760</div>
        <div><span>Fecha</span> {{ date('d-m-Y') }}</div>
      </div>
      <div id="project2">
        <div><span>Bodega: </span>{{ $bodOrg }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
            @foreach($itemsLista as $de)
                <tr>
                    <td class="unit">{!! $de['stock_id'] !!}</td>

                    <td class="unit">
                      @php
                        $itm = DB::table('0_stock_master')
                            ->where('stock_id',$de['stock_id'])
                            ->first();
                        echo $itm->description;
                      @endphp
                    </td>
                    
                    <td class="qty">{!! $de['cantidad'] !!}</td>
                </tr>
            @endforeach   
        </tbody>
      </table>
      <div id="firma">
        <p align="center">Firma encargado de bodega</p>
      </div>
      <div id="firma2">
        <p align="center">Firma usuario solicitante</p>
      </div>
    </main>
    <footer>
      Reporte generado a traves del modulo de gestion de inventario.
    </footer>
  </body>
</html>s