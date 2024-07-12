<?php
$host = 'localhost';
$db = 'agriculture';
$user = 'root';
$pass = 'iloveAvacado22';

// Create a connection to the PostgreSQL database
$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Error in connection: " . pg_last_error());
}

$query = $_GET['query'] ?? '';
$search_results = [];

if ($query) {
    $query = pg_escape_string($conn, $query);
    $sql = "SELECT * FROM articles WHERE title ILIKE '%$query%' OR content ILIKE '%$query%'";
    $result = pg_query($conn, $sql);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    } else {
        echo "Error in query: " . pg_last_error();
    }
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Agricultural Information Portal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <div class="container">
            <h1 id="logo"><a href="index.html"><span>Botswana</span> <span>Agricultural</span> <span>Information Portal</span></a></h1>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="modern-farming-techniques.html">Modern Farming Techniques</a></li>
                    <li><a href="weather.html">Weather</a></li>
                    <li><a href="market.html">Market Prices</a></li>
                    <li><a href="success-stories.html">Success Stories</a></li>
                    <li><a href="forum.html">Forum</a></li>
                    <li><a href="resources.html">Resources</a></li>
                </ul>
                <form class="search-form" action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </nav>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
    </header>

    <section id="search-results">
        <div class="container">
            <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
            <?php if (empty($search_results)): ?>
                <p>No results found.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($search_results as $result): ?>
                        <li>
                            <h3><?php echo htmlspecialchars($result['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($result['content'], 0, 200)) . '...'; ?></p>
                            <a href="article.php?id=<?php echo $result['id']; ?>">Read More</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Botswana Agricultural Information Portal. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
