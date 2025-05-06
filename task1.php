<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "task1");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch unique categories for dropdown
$category_query = $conn->query("SELECT DISTINCT category FROM products");
$categories = [];
while ($row = $category_query->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Capture filter values
$category = $_GET['category'] ?? '';
$min_price = $_GET['price_min'] ?? '';
$max_price = $_GET['price_max'] ?? '';
$sort = $_GET['sort'] ?? '';

// Start SQL query
$sql = "SELECT * FROM products WHERE 1=1";

// Add filters
if ($category) $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
if ($min_price !== '') $sql .= " AND price >= " . floatval($min_price);
if ($max_price !== '') $sql .= " AND price <= " . floatval($max_price);

// Add sorting
switch ($sort) {
    case 'name_asc': $sql .= " ORDER BY name ASC"; break;
    case 'price_asc': $sql .= " ORDER BY price ASC"; break;
    case 'price_desc': $sql .= " ORDER BY price DESC"; break;
    case 'newest': $sql .= " ORDER BY created_at DESC"; break;
    default: $sql .= " ORDER BY id ASC"; break;
}

// Execute query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Filter & Sort Products</h2>

<form method="GET">
    <label>Category:
        <select name="category">
            <option value="">All</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat ?>" <?= ($cat == $category) ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <br><br>
    <label>Price Min: <input type="number" name="price_min" value="<?= htmlspecialchars($min_price) ?>"></label>
    <label>Price Max: <input type="number" name="price_max" value="<?= htmlspecialchars($max_price) ?>"></label>

    <br><br>
    <label>Sort By:
        <select name="sort">
            <option value="">Default</option>
            <option value="name_asc" <?= ($sort == 'name_asc') ? 'selected' : '' ?>>Name A–Z</option>
            <option value="price_asc" <?= ($sort == 'price_asc') ? 'selected' : '' ?>>Price Low to High</option>
            <option value="price_desc" <?= ($sort == 'price_desc') ? 'selected' : '' ?>>Price High to Low</option>
            <option value="newest" <?= ($sort == 'newest') ? 'selected' : '' ?>>Newest First</option>
        </select>
    </label>

    <br><br>
    <button type="submit">Apply Filters</button>
    <button type="reset">Reset</button>
</form>

<h3>Product Results</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Created At</th>
        <th>Category</th>
    </tr>

    <?php if ($result->num_rows): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>$<?= number_format($row['price'], 2) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="4">No products found.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
