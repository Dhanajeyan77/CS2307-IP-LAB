<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tamil Movie Collection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tamil Movie Collection</h2>
        <table>
            <tr>
                <th>Movie Title</th>
                <th>Director</th>
                <th>Release Year</th>
                <th>Genre</th>
            </tr>
            <?php
            $xmlFile = 'movies.xml';
            
            if (file_exists($xmlFile)) {
                $xml = simplexml_load_file($xmlFile);
                
                if ($xml === false) {
                    echo "<tr><td colspan='4'>Failed to load XML file.</td></tr>";
                } else {
                    foreach ($xml->movie as $movie) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($movie->title) . "</td>";
                        echo "<td>" . htmlspecialchars($movie->director) . "</td>";
                        echo "<td>" . htmlspecialchars($movie->year) . "</td>";
                        echo "<td>" . htmlspecialchars($movie->genre) . "</td>";
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
