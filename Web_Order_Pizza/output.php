<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $name = htmlspecialchars($_POST['name']);
  $address = htmlspecialchars($_POST['address']);
  $phone = htmlspecialchars($_POST['phone']);
  $email = htmlspecialchars($_POST['email']);
  $instructions = htmlspecialchars($_POST['delivery-instructions']);
  $crust = htmlspecialchars($_POST['pizza-crust']);
  $toppings = isset($_POST['toppings']) ? $_POST['toppings'] : [];
  $quantity = htmlspecialchars($_POST['quantity']);
?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>Pemesanan Pizza Telah Berhasil </title>
  </head>

  <body>
    <fieldset style="margin-left: 280px; margin-right:280px; background-color:#ffffb4ff;border: 1px solid #ffffb4ff;">
      <h1 class="text-center">THANK YOU</h1>
      <hr style="border: 2px solid lightblue" />
      <p>Thank you for ordering from Blak Goose Bistro. We have received the
        <br> following information about your order:
      </p>
      <p class="text-orange">
        <b>Your Information</b>
      </p>
      <ul type="none">
        <li>
          <p>
            <b>Name:</b> <?= $name ?>
            <br>
            <b>Address:</b> <?= $address ?>
            <br>
            <b>Telephone number:</b> <?= $phone ?>
            <br>
            <b>Email Address:</b> <?= $email ?>
          </p>
        </li>
      </ul>
      <p>
        <b>Delivery instructions:</b> <?= $instructions ?>
      </p>
      <p class="text-orange">
        <b>Your pizza</b>
      </p>
      <ul type="none">
        <li>
          <p>
            <b>Crust:</b> <?= $crust ?>
            <br>
            <b>Toppings:</b>
            <?= implode(", ", $toppings) ?>
            <br>
            <b>Number:</b> <?= $quantity ?>
          </p>
        </li>
      </ul>
      <hr style="border: 1px solid lightsalmon" />
      <p> This site is for educational purposes only. No pizzas will be delivered</p>
    </fieldset>
  </body>

  </html>
<?php
} else {
  echo "<script>alert('Please fill out the form first.');</script>";
  exit();
}
?>