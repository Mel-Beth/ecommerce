<?php
require '../lib/fpdf186/fpdf.php';
require '../includes/db.php';

if (isset($_POST['id'])) {
    $commande_id = $_POST['id'];

    // Récupérer la commande
    $query = $pdo->prepare("SELECT * FROM commandes WHERE id = ?");
    $query->execute([$commande_id]);
    $commande = $query->fetch(PDO::FETCH_ASSOC);

    // Créer un PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // En-tête
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Facture n° ' . $commande['id'], 0, 1, 'C');

    // Informations client
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Client : " . $commande['client'], 0, 1);
    $pdf->Cell(0, 10, "Date : " . $commande['created_at'], 0, 1);

    // Articles commandés
    $pdf->Cell(40, 10, 'Article', 1);
    $pdf->Cell(40, 10, 'Quantite', 1);
    $pdf->Cell(40, 10, 'Prix unitaire', 1);
    $pdf->Cell(40, 10, 'Total', 1);
    $pdf->Ln();

    $items = json_decode($commande['articles'], true);
    foreach ($items as $item) {
        $pdf->Cell(40, 10, $item['name'], 1);
        $pdf->Cell(40, 10, $item['quantity'], 1);
        $pdf->Cell(40, 10, number_format($item['price'], 2) . ' €', 1);
        $pdf->Cell(40, 10, number_format($item['price'] * $item['quantity'], 2) . ' €', 1);
        $pdf->Ln();
    }

    // Total
    $pdf->Cell(0, 10, 'Total : ' . number_format($commande['total'], 2) . ' €', 0, 1, 'R');

    // Générer et télécharger
    $pdf->Output('D', 'Facture-' . $commande['id'] . '.pdf');
}
?>
