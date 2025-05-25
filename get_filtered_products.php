<?php
include 'config.php'; // Change from includes/config.php to config.php

$sortBy = isset($_POST['sortBy']) ? $_POST['sortBy'] : '';
$category = isset($_POST['category']) ? (int)$_POST['category'] : '';

// Add error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Base query
$query = "SELECT * FROM products";

// Add category filter
if ($category) {
    $query .= " WHERE category_id = " . $category;
}

// Add sorting
switch($sortBy) {
    case 'name_asc':
        $query .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $query .= " ORDER BY name DESC";
        break;
    case 'price_asc':
        $query .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY price DESC";
        break;
    default:
        $query .= " ORDER BY name ASC";
}

// Add error checking for query
if (!$result = mysqli_query($conn, $query)) {
    die('Error: ' . mysqli_error($conn));
}

// Build HTML response
$html = '';
while($row = mysqli_fetch_assoc($result)) {
    $html .= '<div class="col-4">';
    $html .= '<a href="product_details.php?id=' . $row['id'] . '">';
    $html .= '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
    $html .= '<h4>' . $row['name'] . '</h4>';
    $html .= '<div class="rating">';
    for($i = 0; $i < 5; $i++) {
        $html .= '<i class="fa fa-star"></i>';
    }
    $html .= '</div>';
    $html .= '<p>' . $row['price'] . '€</p>';
    $html .= '</a>';
    $html .= '</div>';
}

echo $html;
?>