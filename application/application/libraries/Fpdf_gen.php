<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fpdf_gen {
  public function __construct(){
    require_once APPPATH. 'third_party/fpdf/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();

    $CI =& get_instance();
    $CI->fpdf = $pdf;
  }
}

//   function header(){
//
//     $this->Image('logob.png', 18, 3, 40, 35, 'png', '', 0, 1, 'L');
//     $this->SetFont('Arial','B',14);
//     $this->SetTitle('GESTION DES PASSEPORTS MMG');
//     $this->Cell(276,5,'GESTION DES PASSEPORTS MMG',0,0,'C');
//     $this->Ln();
//     $this->SetFont('Times','',12);
//     $this->Cell(276,10,'LISTE DES PASSEPORTS MMG ENTREES-SORTIES',0,0,'C');
//     $this->Ln(20);
//
//   }
//
//   function footer(){
//
//     $this->SetY(-15);
//     $this->SetFont('Arial','',8);
//     $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
//   }
//
//   function headerTable(){
//
//     $fill = True;
//     $this->SetFont('Times','B',12);
//     $this->SetFillColor(67, 187, 70);
//     $this->Cell(20,10,'ID',1,0,'C',$fill);
//     $this->Cell(40,10,'Matricule',1,0,'C',$fill);
//     $this->Cell(50,10,'Motif',1,0,'C',$fill);
//     $this->Cell(36,10,'Montant',1,0,'C',$fill);
//     $this->Cell(50,10,'Date',1,0,'C',$fill);
//     $this->Ln();
//   }
//
//   function viewtable($db){
//
//     $this->SetFont('Times','',12);
//     $stmt = $db->query('SELECT * FROM ez_paiements');
//     while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
//
//
//         $this->setFillColor(230,230,230);
//         $this->Cell(20,10,$data->id_paiement,1,0,'C');
//         $this->Cell(40,10,$data->matricule,1,0,'C');
//         $this->Cell(50,10,$data->motif,1,0,'C');
//         $this->Cell(36,10,$data->montant,1,0,'C');
//         $this->Cell(50,10,$data->date_paiement,1,0,'C');
//         $this->Ln();
//     }
//   }
// }
//
//
//   $pdf = new myPDF();
//   $pdf->AliasNbPages();
//   $pdf->AddPage('L','A4',0);
//   $pdf->headerTable();
//   $pdf->viewtable($db);
//   $pdf->Output();
