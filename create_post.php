<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    
    $query = "INSERT INTO posts (user_id, title, content, tags) VALUES ('{$_SESSION['user_id']}', '$title', '$content', '$tags')";
    
    if (mysqli_query($conn, $query)) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea id="editor" name="content"></textarea>
    <input type="text" name="tags" placeholder="Tags (optional)">
    
    <button type="submit">Publish</button>
</form>

<script src="//cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: '#editor'
});
</script>

<script>
// Auto-save feature
let autoSaveInterval;

document.addEventListener("DOMContentLoaded", function() {
  const contentArea = document.getElementById('editor');

  contentArea.addEventListener('input', function() {
      clearTimeout(autoSaveInterval);
      autoSaveInterval = setTimeout(autoSaveDraft, 5000); // Save every 5 seconds
  });
});

function autoSaveDraft() {
  const content = tinymce.get('editor').getContent();
  
  fetch('auto_save.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ content })
  }).then(response => response.json()).then(data => console.log(data));
}
</script>