<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/book-utilities.inc.php';

// 读取客户
$customers = readCustomers("data/customers.txt");

// 获取点击的客户ID
$selectedID = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Jiaozinan DC229841 - CISC3003 Suggested Exercise 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- 用本地 -->
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">

    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
</head>

<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

<!-- HEADER -->
<header class="mdl-layout__header">
  <div class="mdl-layout__header-row">
     <h1 class="mdl-layout-title">CRM Admin - Jiaozinan DC229841</h1>
     <div class="mdl-layout-spacer"></div>

     <div>
        <label id="tt2" class="material-icons mdl-badge" data-badge="5">account_box</label>
        <div class="mdl-tooltip" data-mdl-for="tt2">Messages</div>

        <label id="tt3" class="material-icons mdl-badge" data-badge="4">notifications</label>
        <div class="mdl-tooltip" data-mdl-for="tt3">Notifications</div>
     </div>
  </div>
</header>

<!-- LEFT（已修复） -->
<div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50">

   <div class="profile">
       <img src="images/profile.jpg" class="avatar" alt="profile">
       <h2>John Locke</h2>
       <span>johnlocke@example.com</span>
   </div>

   <nav class="mdl-navigation mdl-color-text--blue-grey-300">

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">dashboard</i> Dashboard
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">message</i> Messages
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">event</i> Tasks
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">call</i> Orders
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">settings</i> Configure
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">view_list</i> Catalog
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">contacts</i> Customers
       </a>

       <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="#">
           <i class="material-icons">insert_chart</i> Analytics
       </a>

   </nav>

</div>

<main class="mdl-layout__content">
<section class="page-content">

<div class="mdl-grid">

<!-- Customers -->
<div class="mdl-cell mdl-cell--7-col mdl-card mdl-shadow--2dp">
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
    echo "<td><a href='?id={$c['id']}'>{$c['firstName']} {$c['lastName']}</a></td>";
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

<!-- RIGHT -->
<div class="mdl-cell mdl-cell--5-col">

<!-- Customer Details -->
<div class="mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
<h2 class="mdl-card__title-text">Customer Details</h2>
</div>

<div class="mdl-card__supporting-text">

<?php
if ($selectedID) {
    foreach ($customers as $c) {
        if ($c['id'] == $selectedID) {
            echo "<h3>{$c['firstName']} {$c['lastName']}</h3>";
            echo "<p>Email: {$c['email']}</p>";
            echo "<p>Phone: {$c['phone']}</p>";
            echo "<p>{$c['address']}, {$c['city']}</p>";
        }
    }
} else {
    echo "<p>Select a customer</p>";
}
?>

</div>
</div>

<!-- Orders -->
<div class="mdl-card mdl-shadow--2dp">
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
            echo "<td><img src='images/tinysquare/{$o['isbn']}.jpg' width='50' alt='book'></td>";
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

<script>
$(function() {
    $('.sparkline').sparkline('html', { type: 'bar' });
});
</script>

</body>
</html>
