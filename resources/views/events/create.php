<?php
session_start();
if(!isset($_SESSION['user_id']) )
{
    header("Location: login.php");
    exit;
}
require_once '../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">
 
<head>
    <?php require_once '../components/head.php'; ?>
</head>
 
<body>
 
    <?php require_once '../components/header.php'; ?>
 
    <div class="container">
        <h1>New Events</h1>
 
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/eventsController.php?action=create" method="POST" enctype="multipart/form-data">
 
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-input">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-input" rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="img_file">Image:</label>
                <input type="file" name="img_file" id="img_file" class="form-input">
            </div>

            <input type="submit" value="Save Event">
 
        </form>
    </div>
 
</body>
 
</html>