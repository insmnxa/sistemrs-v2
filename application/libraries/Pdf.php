<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    public function generate($html, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename . '.pdf', ["Attachment" => 0]);
            exit();
        } else {
            return $dompdf->output();
        }
    }
}
