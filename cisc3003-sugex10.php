<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/book-utilities.inc.php';

// 读取客户数据
$customers = readCustomers("data/customers.txt");

// 获取选中的客户ID
$selectedID = isset($_GET['id']) ? $_GET['id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CISC3003 Suggested Exercise 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 字体 -->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- 图标 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- ✅ 用本地Material（关键） -->
    <link rel="stylesheet" href="css/material.min.css">

    <!-- 自己样式 -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
</head>

<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- Customers -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>

                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>University</th>
                          <th>City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                      foreach ($customers as $c) {
                          echo "<tr>";

                          echo "<td>
                                <a href='?id={$c['id']}'>
                                {$c['firstName']} {$c['lastName']}
                                </a>
                                </td>";

                          echo "<td>{$c['university']}</td>";
                          echo "<td>{$c['city']}</td>";
                          echo "<td><span class='sparkline'>{$c['sales']}</span></td>";

                          echo "</tr>";
                      }
                      ?>
                      </tbody>

                    </table>
                </div>
              </div>

              <!-- Right side -->
              <div class="mdl-grid mdl-cell--5-col">

                  <!-- Customer Details -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>

                    <div class="mdl-card__supporting-text">
                    <?php
                    if ($selectedID) {
                        foreach ($customers as $c) {
                            if ($c['id'] == $selectedID) {
                                echo "<h4>{$c['firstName']} {$c['lastName']}</h4>";
                                echo "<p>Email: {$c['email']}</p>";
                                echo "<p>Phone: {$c['phone']}</p>";
                                echo "<p>{$c['address']}, {$c['city']}</p>";
                            }
                        }
                    } else {
                        echo "<h4>Select a customer</h4>";
                    }
                    ?>
                    </div>
                  </div>

                  <!-- Orders -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>

                    <div class="mdl-card__supporting-text">
                        <table class="mdl-data-table mdl-shadow--2dp">
                          <thead>
                            <tr>
                              <th>Cover</th>
                              <th>ISBN</th>
                              <th>Title</th>
                            </tr>
                          </thead>

                          <tbody>
                          <?php
                          if ($selectedID) {
                              $orders = readOrders($selectedID, "data/orders.txt");

                              if (count($orders) > 0) {
                                  foreach ($orders as $o) {
                                      echo "<tr>";
                                      echo "<td><img src='images/tinysquare/{$o['isbn']}.jpg' width='50'></td>";
                                      echo "<td>{$o['isbn']}</td>";
                                      echo "<td>{$o['title']}</td>";
                                      echo "</tr>";
                                  }
                              } else {
                                  echo "<tr><td colspan='3'>No orders found</td></tr>";
                              }
                          }
                          ?>
                          </tbody>

                        </table>
                    </div>
                  </div>

              </div>

            </div>

        </section>
    </main>

</div>

<!-- Sparkline -->
<script>
$(function() {
    $('.sparkline').sparkline('html', { type: 'bar' });
});
</script>

</body>
</html>