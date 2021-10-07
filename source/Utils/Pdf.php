<?php

namespace Source\Utils;

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Classe de utilitários PDF
 */
class Pdf
{
   /**
    * Objeto PDf
    *
    * @var Dompdf
    */
   private $dompdf;

   /**
    * Construtor do utilitário PDF
    *
    * @param string $htmlBase
    */
   public function __construct(string $htmlBase)
   {
      // PDF obj
      $options = new Options();
      $options->set('isRemoteEnabled', true);
      $this->dompdf = new Dompdf($options);
      $htmlBase = mb_convert_encoding($htmlBase, 'HTML-ENTITIES', 'UTF-8');
      $this->dompdf->loadHtml($htmlBase);
      $this->dompdf->render("dados.pdf", ['Attachment'=>false]);
   }

   /**
    * Gera o PDF com os dados de acesso do Links
    *
    * @return void
    */
   public function gerarPdfAcessoLinks(): void
   {
      // Output the generated PDF to Browser
      $this->dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
   }
}
