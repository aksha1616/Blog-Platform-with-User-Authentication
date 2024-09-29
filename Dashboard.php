<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM posts WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>

<h1>Your Blog Posts</h1>

<a href="create_post.php">Create New Post</a>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <h2><?php echo $row['title']; ?></h2>
    <p><?php echo substr($row['content'], 0, 100); ?>...</p>
    <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>
    <a href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>
<?php endwhile; ?>