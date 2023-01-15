<?php
namespace Jgauthi\Html2pdf;

use Spipu\Html2Pdf\Html2Pdf as BaseHtml2Pdf;

class Html2PdfEnhanced extends BaseHtml2Pdf
{
    public const ORIENTATION_PORTRAIT = 'P';
    public const ORIENTATION_LANDSCAPE = 'L';
    public const FORMAT_A3 = 'A3';
    public const FORMAT_A4 = 'A4';
    public const EXPORT_BROWSER_INLINE = 'I';
    public const EXPORT_BROWSER_FORCE = 'D';
    public const EXPORT_AS_FILE = 'F';
    public const EXPORT_AS_EMAIL_FILE = 'E';

    private string $file;
    private ?string $title;

    public function __construct(
        $orientation = self::ORIENTATION_PORTRAIT,
        $format = self::FORMAT_A3,
        $lang = 'fr',
        $unicode = true,
        $encoding = 'UTF-8',
        $margins = [5, 5, 5, 8],
        $pdfa = false,
    ) {
        parent::__construct($orientation, $format, $lang, $unicode, $encoding, $margins, $pdfa);
        $this->file = basename($_SERVER['PHP_SELF']);
    }

    public function setInfo(
        string $file,
        ?string $title = null,
        ?string $author = null,
        ?string $subject = null,
        ?string $keywords = null,
    ): self {
        $this->file = $file;
        $this->title = $title;
        $this->pdf->SetTitle($title);

        if (!empty($author)) {
            $this->pdf->SetAuthor($author);
        }
        if (!empty($subject)) {
            $this->pdf->SetSubject($subject);
        }
        if (!empty($keywords)) {
            $this->pdf->SetKeywords($keywords);
        }

        return $this;
    }

    /**
     * @param string $html
     */
    public function writeHTML($html): static
    {
        $title = $this->title;
        if (empty($title)) {
            // Get title from doc
            if (preg_match('#<h1>([^<]+)</h1>#i', $html, $row)) {
                $title = strip_tags($row[1]);
            } else {
                $title = basename($this->file);
            }
        }

        $dir = __DIR__;
        $html = '
		<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
			<page_header>
				<table style="width: 100%; border: solid 1px black;">
					<tr>
						<td style="text-align: left; width: 33%">md2pdf</td>
						<td style="text-align: center; width: 34%">'.$title.'</td>
						<td style="text-align: right; width: 33%">'.date('d/m/Y').'</td>
					</tr>
				</table>
			</page_header>
			<page_footer>
				<table style="width: 100%;">
					<tr>
						<td style="text-align: left; width: 50%"><i>'.$this->file.'</i></td>
						<td style="text-align: right; width: 50%">page [[page_cu]]/[[page_nb]]</td>
					</tr>
				</table>
			</page_footer>
			<link type="text/css" href="'.$dir.'/../../template/example.css" rel="stylesheet" />
			'.$html.'
		</page>';

        return parent::writeHTML($html);
    }
}
