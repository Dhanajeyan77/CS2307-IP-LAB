<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Book Collection</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publication Year</th>
                <th>Price ($)</th>
            </tr>
            <?php
            $xmlFile = 'books.xml';
            
            if (file_exists($xmlFile)) {
                $xml = simplexml_load_file($xmlFile);
                
                if ($xml === false) {
                    echo "<tr><td colspan='4'>Failed to load XML file.</td></tr>";
                } else {
                    foreach ($xml->book as $book) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($book->title) . "</td>";
                        echo "<td>" . htmlspecialchars($book->author) . "</td>";
                        echo "<td>" . htmlspecialchars($book->publication_year) . "</td>";
                        echo "<td>$" . number_format((float)$book->price, 2) . "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='4'>XML file not found.</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="index.html" class="btn">Go Back</a>
    </div>
</body>
</html>
