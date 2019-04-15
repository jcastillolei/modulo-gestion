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
      <h1>Transferencia Item</h1>
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
        <div><span>Bodega Origen</span>{{ $bodOrg }}</div>
        <div><span>Bodega Destino</span>{{ $bodDes }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Item</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td class="unit">{!! $d['stock_id'] !!}</td>
                    <td class="qty">{!! $d['cantidad'] !!}</td>
                </tr>
            @endforeach    
        </tbody>
      </table>
      <div id="firma3">
        <p align="center">Firma encargado de bodega</p>
      </div>
    </main>
    <footer>
      Reporte generado a traves del modulo de gestion de inventario.
    </footer>
  </body>
</html>s