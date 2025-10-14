<?php
// Pastikan semua error ringan tidak mengganggu tampilan
error_reporting(E_ALL & ~E_NOTICE);

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $title        = $_POST["title"] ?? 'MacBook Air £800';
    $year         = $_POST["year"] ?? '2004';
    $model        = $_POST["model"] ?? 'Condition: Mint';
    $amount       = $_POST["amount"] ?? '£800';
    $payto        = $_POST["payto"] ?? '123-456-789-0';
    $paymentType  = $_POST["payment-type"] ?? 'Visa Debit';
    $holder       = $_POST["account-holder"] ?? 'Name Here';
    $accountNum   = $_POST["account-number"] ?? '123-456-789-0';
    $sendMobile   = isset($_POST["send-mobile"]);
    $sendEmail    = isset($_POST["send-email"]);
    $mobileNumber = $_POST["mobile-number"] ?? '1234567890, 1234567891';
    $email        = $_POST["email"] ?? 'mmfmr29@stoton.ac.uk, fys_06@yahoo.com';

    // Proses upload gambar
    $imagePath = "";
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        $imagePath = $targetFile;
    } elseif (!empty($_POST["imageData"])) {
        // Jika gambar dikirim dalam bentuk base64
        $imgData = $_POST["imageData"];
        $imgData = str_replace(['data:image/png;base64,', 'data:image/jpeg;base64,'], '', $imgData);
        $imgData = str_replace(' ', '+', $imgData);
        $fileData = base64_decode($imgData);
        if (!file_exists("uploads")) mkdir("uploads");
        $fileName = "uploads/image_" . time() . ".png";
        file_put_contents($fileName, $fileData);
        $imagePath = $fileName;
    }
} else {
    // Nilai default (jika halaman dibuka tanpa form)
    $title        = 'MacBook Air £800';
    $year         = '2004';
    $model        = 'Condition: Mint';
    $amount       = '£800';
    $payto        = '123-456-789-0';
    $paymentType  = 'Visa Debit';
    $holder       = 'Name Here';
    $accountNum   = '123-456-789-0';
    $sendMobile   = false;
    $sendEmail    = false;
    $mobileNumber = '1234567890, 1234567891';
    $email        = 'mmfmr29@stoton.ac.uk, fys_06@yahoo.com';
    $imagePath    = '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Produk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #e0e0e0;
      padding: 8px 20px;
      font-size: 1px;
      font-weight: bold;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }
    nav {
      background-color: #f0f0f0;
      padding: 10px;
      text-align: center;
      border-bottom: 2px solid #ccc;
    }
    nav a {
      text-decoration: none;
      color: black;
      font-weight: bold;
      margin: 0 15px;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: white;
    }
    nav a:hover {
      background-color: #e0e0e0;
    }
    .container {
      width: 900px;
      background: white;
      margin: 40px auto;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      display: flex;
      gap: 40px;
    }
    .left {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ccc;
      min-height: 250px;
      background-color: #fafafa;
      border-radius: 6px;
    }
    .left img {
      max-width: 98%;
      max-height: 200px;
      object-fit: contain;
      border-radius: 6px;
    }
    .right {
      flex: 2;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      padding: 8px 5px;
      vertical-align: top;
    }
    td:first-child {
      font-weight: bold;
      width: 35%;
    }
    .btn-pay {
      display: block;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      padding: 12px;
      border-radius: 6px;
      text-decoration: none;
      margin-top: 20px;
      font-weight: bold;
    }
    .btn-pay:hover {
      background-color: #3e8e41;
    }
  </style>
</head>
<body>

<header>Web Produk</header>

<nav>
  <a href="#">Home</a>
  <a href="#">Register</a>
  <a href="#">Policy</a>
  <a href="#">About</a>
</nav>

<div class="container">
  <div class="left">
    <?php if ($imagePath): ?>
      <img src="<?= htmlspecialchars($imagePath) ?>" alt="Product Image">
    <?php else: ?>
      <p><em>No Image</em></p>
    <?php endif; ?>
  </div>

  <div class="right">
    <table border="0" cellpadding="5" cellspacing="0" width="100%">
      <tr>
        <td><b>Title Here:</b></td>
        <td><?= htmlspecialchars($title) ?></td>
      </tr>
      <tr>
        <td><b>Description:</b></td>
        <td>Year: <?= htmlspecialchars($year) ?><br>Model: <?= htmlspecialchars($model) ?></td>
      </tr>
      <tr>
        <td><b>Total Amount:</b></td>
        <td><?= htmlspecialchars($amount) ?></td>
      </tr>
      <tr>
        <td><b>Pay to:</b></td>
        <td><?= htmlspecialchars($payto) ?></td>
      </tr>
      <tr>
        <td><b>Payment Type:</b></td>
        <td><?= htmlspecialchars($paymentType) ?></td>
      </tr>
      <tr>
        <td><b>Account Holder:</b></td>
        <td><?= htmlspecialchars($holder) ?></td>
      </tr>
      <tr>
        <td><b>Account No:</b></td>
        <td><?= htmlspecialchars($accountNum) ?></td>
      </tr>
      <tr>
        <td><b>Notification:</b></td>
        <td>
          <?php if ($sendMobile) echo "☑ Send to Mobile Phone<br>"; ?>
          <?php if ($sendEmail) echo "☑ Email me copy of transaction"; ?>
        </td>
      </tr>
      <tr>
        <td><b>Send to Mobile Phone:</b></td>
        <td><?= htmlspecialchars($mobileNumber) ?></td>
      </tr>
      <tr>
        <td><b>Send to Email:</b></td>
        <td><?= htmlspecialchars($email) ?></td>
      </tr>
    </table>
    <a href="#" class="btn-pay">Confirm Payment</a>
  </div>
</div>

</body>
</html>
