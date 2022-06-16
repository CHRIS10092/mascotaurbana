<?php
session_start();
?><div class="table-responsive">
    <table class="table table-striped table-hover" id="tbl-detalle">
        <thead>
            <tr>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>TOTAL</th>

                <th>QUITAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
			$total    = 0;
			$iva      = 0;
			$subtotal = 0;
			if (isset($_SESSION['ventas'])) :
				$i = 0;
				foreach ($_SESSION['ventas'] as $datos) {
					$d = explode('||', $datos);

					$subtotal = $d[4] / 1.12;
					round($subtotal, 2);

			?>
            <tr>
                <td><?php echo $d[0] ?></td>
                <td><?php echo $d[1] ?></td>
                <td><?php echo $d[2] ?></td>
                <td><?php echo $d[3] ?></td>
                <td><?php echo round($subtotal, 2) ?></td>
                <td><?php echo $valor = $d[4] * $d[3] ?></td>
                <td>
                    <span class="btn btn-danger" onclick="quitar('<?php echo $i ?>')">
                        <i class="fa fa-trash"></i>
                    </span>
                </td>
            </tr>

            <?php
					//print_r($datos);
					$i++;
					$total    = $total + $valor;
					$subtotal = $total / 1.12;
					$iva      = $total - $subtotal;
				}

			endif;
			?>
        </tbody>
    </table>

    <ul style="margin-left: 0%;" class="list-group">
        <li class="list-group-item">SUBTOTAL: <input type="hidden" id="txt-subtotal" name="subtotal"
                value="<?php echo round($subtotal, 2); ?>">
            <div style="float:right;"><?php echo round($subtotal, 2); ?></div>
        </li>
        <li class="list-group-item">IVA %12 <input type="hidden" name="iva" id="txt-iva"
                value="<?php echo round($iva, 2); ?>">
            <div style="float:right;"><?php echo round($iva, 2); ?></div>
        </li>
        <li class="list-group-item">TOTAL: <input type="hidden" id="txt-total" name="total"
                value="<?php echo round($total, 2); ?>">
            <div style="float:right;"><?php echo round($total, 2); ?></div>
        </li>


    </ul>

</div>