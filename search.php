<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
   $query = "SELECT * FROM posts WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%' OR tags LIKE '%$searchTerm%'";
   $result = mysqli_query($conn, $query);
   
   while ($row = mysqli_fetch_assoc($result)) {
       echo "<h2>{$row['title']}</h2>";
       echo "<p>{$row['content']}</p>";
       echo "<p>Tags: {$row['tags']}</p>";
   }
}
?>

<form action="" method="POST">
   <input type="text" name="search" placeholder="Search...">
   <button type="submit">Search</button>
</form>