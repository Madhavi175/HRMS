<?php
include('db_connection.php');

// Export to Excel
if (isset($_POST['export_excel'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="employee_payments.xls"');
    header('Cache-Control: max-age=0');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Employee ID', 'Name', 'Salary', 'Reimbursement', 'Loan Status', 'Tax Deduction']);

    $sql = "SELECT * FROM employee_payments";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}

// Export to PDF
if (isset($_POST['export_pdf'])) {
    require('fpdf/fpdf.php'); // If fpdf is directly inside the hrms folder


    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    
    $pdf->Cell(30, 10, 'Employee ID', 1);
    $pdf->Cell(60, 10, 'Name', 1);
    $pdf->Cell(30, 10, 'Salary', 1);
    $pdf->Cell(40, 10, 'Reimbursement', 1);
    $pdf->Cell(30, 10, 'Loan Status', 1);
    $pdf->Cell(30, 10, 'Tax Deduction', 1);
    $pdf->Ln();

    $sql = "SELECT * FROM employee_payments";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 10, $row['EmployeeId'], 1);
        $pdf->Cell(60, 10, $row['Name'], 1);
        $pdf->Cell(30, 10, $row['Salary'], 1);
        $pdf->Cell(40, 10, $row['Reimbursement'], 1);
        $pdf->Cell(30, 10, $row['LoanStatus'], 1);
        $pdf->Cell(30, 10, $row['TaxDeduction'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'employee_payments.pdf');
    exit();
}

// Close database connection
mysqli_close($conn);
?>
