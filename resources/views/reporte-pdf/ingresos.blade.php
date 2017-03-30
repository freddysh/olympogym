<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Membresia</th>
        <th>Cuotas</th>
        <th>fecha</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
    <?php $st=0;?>
    @foreach($ingresos as $ingreso)
        <?php $i++?>
        <tr>
            <td>{{$i}}</td>
            <td>
                <p class="text-blue">{{$ingreso->promocion->titulo}} x {{$ingreso->promocion->duracion}} {{$ingreso->promocion->tipoDuracion}}</p>
                <p>Cliente: {{$ingreso->cliente->dni}} {{$ingreso->cliente->nombres}} {{$ingreso->cliente->apellidos}}</p>
            </td>
            <td>
            @foreach($ingreso->cuotas as $cuota)
                    <?php $st+=$cuota->monto;?>
                    <p>{{$cuota->monto}}</p>
            @endforeach
            </td>
            <td>
                @foreach($ingreso->cuotas as $cuota)
                    <?php
                    $dated = new \DateTime($cuota->fechaQCancelo);
                    ?>
                    <p><?php echo $dated->format('d-m-Y');?></p>
                @endforeach
            </td>
        </tr>
    @endforeach
        <td></td>
        <td><b>Total</b></td>
        <td><b><?php echo number_format($st, 2, '.', '');?></b></td>
        <td></td>
    </tbody>
</table>
