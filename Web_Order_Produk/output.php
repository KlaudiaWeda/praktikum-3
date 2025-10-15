

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
  $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
  $accountNumber = isset($_POST['account-number']) ? htmlspecialchars($_POST['account-number']) : '';
  $bank = isset($_POST['bank']) ? htmlspecialchars($_POST['bank']) : '';
  $accountHolder = isset($_POST['account-holder']) ? htmlspecialchars($_POST['account-holder']) : '';
  $mobileNumber = isset($_POST['mobile-number']) ? htmlspecialchars($_POST['mobile-number']) : '';
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
  $imageData = isset($_POST['imageData']) ? $_POST['imageData'] : '';
  
  $sendMobile = isset($_POST['send-mobile']) ? 'checked' : '';
  $sendEmail = isset($_POST['send-email']) ? 'checked' : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Generate Nbr Link - Output</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <nav>
      <a href="index.html">Home</a>
      <a href="index.html">Generate Link</a>
      <a href="#">Transaction History</a>
      <a href="#">Policy</a>
      <a href="#">Logout</a>
    </nav>

    <div id="container-form-nbr-link">
      <div class="form-layout">
        <div class="left-side">
          <div class="upload-box">
            <div class="image-placeholder" id="imagePreview">
              <?php if (!empty($imageData)): ?>
                <img src="<?= $imageData ?>" alt="Preview" style="width:100%; height:180px; object-fit:contain;">
              <?php else: ?>
                <span>No Image</span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="right-side">
          <form
            action="output.php"
            method="POST"
            enctype="multipart/form-data"
            id="nbr-link-form"
          >
            <div class="form-group">
              <label for="title">Title Here:</label>
              <input
                type="text"
                id="title"
                name="title"
                value="<?= $title ?>"
                readonly
              />
            </div>

            <div class="form-group">
              <label for="description">Description:</label>
              <textarea
                id="description"
                name="description"
                rows="4"
                readonly
              ><?= $description ?></textarea>
            </div>

            <div class="form-group">
              <label for="account-number">Account Number:</label>
              <input
                type="text"
                id="account-number"
                name="account-number"
                value="<?= $accountNumber ?>"
                readonly
              />
            </div>

            <div class="form-group">
              <label for="bank">Bank:</label>
              <select id="bank" name="bank" disabled>
                <option <?= $bank == 'Choose Your Bank' ? 'selected' : '' ?>>Choose Your Bank</option>
                <option <?= $bank == 'HSBC' ? 'selected' : '' ?>>HSBC</option>
                <option <?= $bank == 'BCA' ? 'selected' : '' ?>>BCA</option>
                <option <?= $bank == 'BNI' ? 'selected' : '' ?>>BNI</option>
                <option <?= $bank == 'Mandiri' ? 'selected' : '' ?>>Mandiri</option>
              </select>
            </div>

            <div class="form-group">
              <label for="account-holder">Account Holder:</label>
              <input
                type="text"
                id="account-holder"
                name="account-holder"
                value="<?= $accountHolder ?>"
                readonly
              />
            </div>

            <div class="form-group">
              <label>Transaction:</label>
              <p class="note">
                * If the transaction is for 3 persons, choose 3 from the
                drop-down list
              </p>
              <div class="checkboxes">
                <label>
                  <input type="checkbox" name="send-mobile" value="1" <?= $sendMobile ?> disabled />
                  Send to Mobile Phone
                </label>
                <label>
                  <input type="checkbox" name="send-email" value="1" <?= $sendEmail ?> disabled />
                  Send to Email
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="mobile-number">Send to Mobile Phone:</label>
              <input
                type="text"
                id="mobile-number"
                name="mobile-number"
                value="<?= $mobileNumber ?>"
                readonly
              />
            </div>

            <div class="form-group">
              <label for="email">Send to Email:</label>
              <input
                type="email"
                id="email"
                name="email"
                value="<?= $email ?>"
                readonly
              />
            </div>

            <div class="button-group">
              <button type="button" onclick="window.location.href='index.html'">
                Create New Link
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
} else {
  echo "<script>alert('Please fill out the form first.'); window.location.href='index.html';</script>";
  exit();
}
?>
