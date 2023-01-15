<?php
require_once __DIR__.'/init.inc.php';

use Jgauthi\Html2pdf\Html2PdfEnhanced;
use Spipu\Html2Pdf\Exception\{ExceptionFormatter, Html2PdfException};

ob_start();
require_once PATH_TEMPLATE . '/example_table.inc.php';
$content = ob_get_clean();

if (!isset($_GET['download']) && !isset($_GET['file'])) {
    ?><ul>
        <li><a href="?download">Récupérer le devis</a></li>
        <li><a href="?file">Sauvegarder le pdf dans le dossier data</a></li>
    </ul><?php
    die();
}

try {
    $pdf = new Html2PdfEnhanced(
        Html2PdfEnhanced::ORIENTATION_PORTRAIT,
        Html2PdfEnhanced::FORMAT_A4,
        'fr',
    );

    $pdf->setInfo('Devis.pdf', 'Devis 14', 'DOE John', 'Création d\'un Portfolio', 'HTML2PDF, Devis, PHP');
    // $pdf->pdf->SetAuthor('DOE John');
    // $pdf->pdf->SetTitle('Devis 14');
    // $pdf->pdf->SetSubject('Création d\'un Portfolio');
    // $pdf->pdf->SetKeywords('HTML2PDF, Devis, PHP');

    $pdf->writeHTML($content);

    if (isset($_GET['file'])) {
        $file = PATH_EXPORT_PDF.'/Devis.pdf';
        $pdf->Output($file, Html2PdfEnhanced::EXPORT_AS_FILE);
        echo '<p>Fichier généré: <a href="'.RELATIVE_URL_EXPORT_PDF.'/Devis.pdf">Devis.pdf</a> - <a href="'. $_SERVER['PHP_SELF'] .'">Retour</a></p>';

    } else {
        $pdf->Output('Devis.pdf');
    }

} catch (Html2PdfException $e) {
    $pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
