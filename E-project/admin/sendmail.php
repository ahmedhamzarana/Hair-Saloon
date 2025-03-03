<?php


require '../vendor/autoload.php';
include('../users/config.php');
include('email.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkedItems = $_POST['items'] ?? [];
    $supplier = $_POST['supplier'];
    $quantities = $_POST['quantity'];

    if (empty($checkedItems)) {
        echo "<script>alert('No items selected!')</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }

    $lowStockItems = [];
    foreach ($checkedItems as $key => $itemName) {
        $itemQuantity = $quantities[$key] ?? 0; // Matching quantity for the same key
        $lowStockItems[] = "{$itemName} ({$itemQuantity} units)";
    }

    $body = "Alert: The following items have been marked for restocking:\n\n";
    $body .= implode("\n", $lowStockItems);

    sendMail($supplier, 'Stock Alert', $body);

    echo "<script>alert('Email sent successfully!')</script>";
    echo "<script>window.location.href='showinventory.php'</script>";
}
?>

