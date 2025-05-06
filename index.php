<?php 
    $conn = mysqli_connect("localhost", "root", "", "task1");

    if($conn)
    {
        echo "<b> Connected <b>";
    }
    else
    {
        echo "Not Connected";
    }

    $category_result = $conn->query("SELECT DISTINCT category FROM products");
    $categories = [];
    while ($row = $category_result->fetch_assoc()) {
        $categories[] = $row['category'];
    }

    $sort_option = $_GET['sort'] ?? '';
    $price_min = $_GET['price_min'] ?? '';
    $price_max = $_GET['price_max'] ?? '';
    $category = $_GET['category'] ?? '';

    
    $sql = "SELECT * FROM products WHERE 1=1";

    if (!empty($category)) {
        $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
    }

    if($price_min !== '')
    {
        $sql .=" AND price >= ".floatval($price_min);
    }
    if($price_max !== '')
    {
        $sql .=" AND price <= ".floatval($price_max);
    }
    
    switch($sort_option)
    {
        case 'name_asc':
            $sql .= " ORDER BY name ASC";
            break;

        case 'name_desc':
            $sql .= " ORDER BY name DESC";
            break;

        case 'price_asc':
            $sql .= " ORDER BY price ASC";
            break; 
        
        case 'price_desc':
            $sql .= " ORDER BY price DESC";
            break;

        case 'newest':
            $sql .= " ORDER BY created_at DESC";
            break;
        
        default:
        $sql .= " ORDER BY id ASC";

    }
        
    $result = $conn->query($sql);
    
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Listing Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Product Listing</h1>

    <form action="" method="GET">
        
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="">-- Select --</option>
            <option value="name_asc" <?php echo ($sort_option == 'name_asc') ? 'selected' : ''; ?>>Name A–Z</option> 
            <option value="name_desc" <?php echo ($sort_option == 'name_desc') ? 'selected' : ''; ?>>Name Z–A</option> 
            <option value="price_asc" <?php echo ($sort_option == 'price_asc') ? 'selected' : ''?>>Price (Low to High)</option>
            <option value="price_desc" <?php echo ($sort_option == 'price_desc') ? 'selected' : ''?>>Price (High to Low)</option>
            <option value="newest" <?php echo ($sort_option == 'newest') ? 'selected' : ''?>>Newest First</option>
        </select>

        <label>Price Range:</label>
        Min: <input type="number" name="price_min" value="<?php echo $price_min ?>">
        Max: <input type="number" name="price_max" value="<?php echo $price_max ?>"><br><br>

        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">-- All Categories --</option>        
            
            <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat ?>" <?= ($cat == $category) ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
            <?php endforeach; ?>

        </select>
        <button type="submit" class="submit-btn" name="submit">Apply Filters</button>
        <a href="index.php" >
            <button type="button" class="submit-btn">Reset</button>
        </a>

    </form>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Created At</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>

            <?php

                $total = mysqli_num_rows($result); //it will presents how many number of rows are present in the table

                if($total != 0)
                    { 
                // error_reporting(0);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['price']."</td>
                    <td>".$row['created_at']."</td>
                    <td>".$row['category']."</td>
                    </td>
                    </tr>";
                }
            }
            else{
                echo "<tr><td colspan='5'>No products found.</td></tr>";
            }
        ?>
        </tbody>

       

    </table>

</body>
</html>
