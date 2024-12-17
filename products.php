<?php
session_start(); // Start session to access session variables

if (!isset($_SESSION['user'])) {
    header('Location: login_form.php');
    exit();
}

include 'config.php';
global $connection;

// Pagination and search setup
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$limit = 10;
$offset = ($page - 1) * $limit;

// Fetch products
$sql = "SELECT * FROM products WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $connection->query($sql);

// Fetch total products for pagination
$total = $connection->query("SELECT COUNT(*) AS total FROM products WHERE name LIKE '%$search%'")->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom responsive styles */
        body {
            background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Keeps background fixed during scroll */
            background-size: cover;
            /* Ensures image covers entire viewport */
            min-height: 100vh;
            /* Full viewport height */
            margin: 0;
            padding: 0;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 25px;
            overflow-x: hidden;
            /* Prevents horizontal scrolling */
        }

        .products-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-input {
            max-width: 400px;
            width: 100%;
        }

        .table-responsive {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        .product-image {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .products-container {
                padding: 10px;
            }

            .table-responsive {
                font-size: 14px;
            }

            .product-image {
                max-width: 60px;
            }

            .pagination {
                flex-wrap: wrap;
                gap: 5px;
            }
        }

        @media (max-width: 480px) {
            .table-responsive {
                font-size: 12px;
            }

            .product-image {
                max-width: 40px;
            }

            .search-container {
                flex-direction: column;
                align-items: center;
            }

            .search-input {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="home.php">Home</a>
            <a class="navbar-brand text-light" href="products.php">Products</a>
            <form action="logout.php" method="POST" class="ms-auto">
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container products-container">
        <h1 class="text-center mb-4">Products</h1>

        <div class="search-container mb-3">
            <form method="GET" action="products.php" class="d-flex">
                <input
                    type="text"
                    name="search"
                    class="form-control search-input me-2"
                    value="<?php echo htmlspecialchars($search); ?>"
                    placeholder="Search products..." />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Price (MYR)</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($product = $result->fetch_assoc()): ?>
                            <tr>
                                <?php
                                $imagePath = htmlspecialchars($product['picture']);
                                ?>
                                <td>
                                    <?php if (file_exists($imagePath) && !empty($imagePath)): ?>
                                        <img src="<?php echo $imagePath; ?>"
                                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                                            class="product-image">
                                    <?php else: ?>
                                        <span>No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td><?php echo htmlspecialchars($product['type']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($product['price']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($product['quantity']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Product pages">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="products.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$connection->close();
?>