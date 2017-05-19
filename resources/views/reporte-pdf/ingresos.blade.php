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
        <?php $contador=0;?>
        @foreach($ingreso->cuotas as $cuota)
            @if($cuota->estado=='1')
                <?php $contador=1;?>
            @endif
        @endforeach

        <?php if($contador==1){ $i++?>
        <tr>
            <td>{{$i}}</td>
            <td>
                <p class="text-blue">{{$ingreso->promocion->titulo}} x {{$ingreso->promocion->duracion}} {{$ingreso->promocion->tipoDuracion}}</p>
                <p>Cliente: {{$ingreso->cliente->dni}} {{$ingreso->cliente->nombres}} {{$ingreso->cliente->apellidos}}</p>
            </td>
            <td>
            @foreach($ingreso->cuotas as $cuota)
                    @if($cuota->estado=='1')
                        <?php $st+=$cuota->monto;?>
                        <p>{{$cuota->monto}}</p>
                    @endif
            @endforeach
            </td>
            <td>
                @foreach($ingreso->cuotas as $cuota)
                    @if($cuota->estado=='1')
                        <?php
                        $dated = new \DateTime($cuota->fechaQCancelo);
                        ?>
                        <p><?php echo $dated->format('d-m-Y');?></p>
                    @endif
                @endforeach
            </td>
        </tr>
        <?php }?>
    @endforeach
        <td></td>
        <td><b>Total</b></td>
        <td><b><?php echo number_format($st, 2, '.', '');?></b></td>
        <td></td>
    </tbody>
</table>
