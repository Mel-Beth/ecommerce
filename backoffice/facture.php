<?php
require '../config/db.php';
require '../libs/fpdf/fpdf.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Commande non spécifiée.");
}

$query = $pdo->prepare("SELECT * FROM commandes WHERE id = ?");
$query->execute([$id]);
$commande = $query->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande introuvable.");
}

$articles = json_decode($commande['items'], true);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Facture de commande');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Commande n°' . $commande['id']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Date : ' . $commande['created_at']);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Statut : ' . $commande['status']);
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Produit', 1);
$pdf->Cell(30, 10, 'Quantite', 1);
$pdf->Cell(30, 10, 'Prix', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$total = 0;
foreach ($articles as $item) {
    $pdf->Cell(80, 10, $item['name'], 1);
    $pdf->Cell(30, 10, $item['quantity'], 1);
    $pdf->Cell(30, 10, number_format($item['price'], 2) . ' €', 1);
    $pdf->Cell(30, 10, number_format($item['quantity'] * $item['price'], 2) . ' €', 1);
    $pdf->Ln();
    $total += $item['quantity'] * $item['price'];
}
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Total : ' . number_format($total, 2) . ' €');

$pdf->Output();
?>
