<?php
require_once 'libreria/vendor/autoload.php';

class Pdf extends TCPDF {

    public function Header() {
        $image_file = __DIR__.'../assets/img/logo.jpg';
        $this->Image($image_file, 10, 3, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 15, 'Pedido Beijing import', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
 
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 15);
        $this->Cell(0, 10, 'Gracias por su preferencia', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
 
    public function printTable($header){
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B', 12);
 
        $w = array(90, 20, 28, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
 
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
 
        //Obtener los productos del carro
        $carro = $_SESSION['carro'];

         // table data
         $fill = 0;

        // Se recorren los elementos del carro y se guardan en la variable $elemento
        foreach($carro as $indice => $elemento){
            // Se guarda el elemento objeto "producto" en la variable producto
            $producto = $elemento['producto'];
            $unidades = $elemento['unidades'];
            $monto = $elemento['unidades'] * $producto->precio;
            $monto = number_format($monto, 0, ' ', '.');
            $precio = $producto->precio;
            $precio = number_format($precio, 0, ' ', '.');

            $this->Cell($w[0], 6, $producto->nombre, 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $unidades, 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, '$'.$precio, 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, '$'.$monto, 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }

        // Obtener la cantidad de productos y el precio total
        $stats = Utils::statsCarro(); 

        // Formatear un número con los millares agrupados
        $precioTotal = $stats['total'];
        $total = number_format($precioTotal, 0, ' ', '.');

        /*
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
            $total+=$row[3];
        }*/
 
        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, '', 'LR', 0, 'R', $fill);
        $this->Ln();
 
        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, 'TOTAL:', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, '$'.$total, 'LR', 0, 'R', $fill);
        $this->Ln();
 
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
?>