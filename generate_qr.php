<?php
header('Content-Type: application/json');

// Database connection parameters
$host = 'localhost';
$dbname = 'qrcode';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['memberId']) || !isset($input['amount'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    exit;
}

$memberId = htmlspecialchars($input['memberId']);
$amount = htmlspecialchars($input['amount']);

$payBillNumber = "123456";
$accountNumber = "LIB" . $memberId;
$amountValue = str_replace("$", "", $amount);

// Construct the payment URL (replace with actual payment processor URL)
$paymentUrl = "https://payment-processor.com/pay?paybill=$payBillNumber&account=$accountNumber&amount=$amountValue";

// Use Google Chart API for QR code generation
$qrCodeUrl = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($paymentUrl) . "&choe=UTF-8";

// Save payment data to the database
try {
    $stmt = $pdo->prepare("INSERT INTO payments (memberId, amount, accountNumber, paymentStatus) VALUES (:memberId, :amount, :accountNumber, 'Pending')");
    $stmt->execute([
        ':memberId' => $memberId,
        ':amount' => $amountValue,
        ':accountNumber' => $accountNumber,
    ]);

    if ($qrCodeUrl) {
        echo json_encode(['success' => true, 'qrCodeUrl' => $qrCodeUrl]);
    } else {
        echo json_encode(['success' => false, 'message' => 'QR code generation failed.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>


