<?php
if ($_GET['action'] == 'create') {

    $title = $_POST['title'];
    if (empty($title)) {
        $errors[] = "Vul de title-naam in.";
    }

    $description = $_POST['description'];
    
    // Check if an image file is uploaded
    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == UPLOAD_ERR_OK) {
        // Set the upload directory
        $uploadDir = '../../../public_html/img/';
        $uploadFile = $uploadDir . basename($_FILES['img_file']['name']);
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['img_file']['tmp_name'], $uploadFile)) {
            $imgFile = basename($_FILES['img_file']['name']);
        } else {
            $errors[] = "Het bestand kon niet worden geüpload.";
        }
    } else {
        $imgFile = null; // Or handle the error as needed
    }

    // 1. Verbinding
    require_once '../../../config/conn.php';
    
    // 2. Query
    $query = 'INSERT INTO events (title, description, img_file) VALUES (:title, :description, :img_file)';
    
    // 3. Prepare
    $statement = $conn->prepare($query);
    
    // 4. Execute
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":img_file" => $imgFile
    ]);
    
    header("Location: " . $base_url . "/resources/views/events/index.php?msg=Event Saved&type=saved");
}


if ($_GET['action'] == 'edit') {
    // Edit existing record

    $title = $_POST['title'];
    if (empty($title)) {
        $errors[] = "Vul de title-naam in.";
    }

    $description = $_POST['description'];
    $id = $_POST['id']; // Assuming the ID is sent via POST

    // Check if an image file is uploaded
    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == UPLOAD_ERR_OK) {
        // Set the upload directory
        $uploadDir = '../../../public_html/img/';
        $uploadFile = $uploadDir . basename($_FILES['img_file']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['img_file']['tmp_name'], $uploadFile)) {
            $imgFile = basename($_FILES['img_file']['name']);
        } else {
            $errors[] = "Het bestand kon niet worden geüpload.";
        }
    } else {
        $imgFile = null; // If no file uploaded, keep the existing file
    }
    require_once '../../../config/conn.php';

    // Query to update data
    $query = "UPDATE events SET title = :title, description = :description, img_file = :img_file WHERE id = :id";

    // Prepare and execute
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":img_file" => $imgFile,
        ":id" => $id
    ]);

    header("Location: " . $base_url . "/resources/views/events/index.php?msg=Event Edited&type=edited");
}
 
 
if ($_GET['action'] == 'delete') {
    $id = $_POST['id'];
    require_once '../../../config/conn.php';
    $query = "SELECT img_file FROM events WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
    $event = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        echo "Event not found.";
        exit;
    }

    $old_img_file = $event['img_file'];
    $uploadDir = '../../../public_html/img/';

    // Delete the record from the database
    $query = "DELETE FROM events WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);

    // Delete the old image file
    if ($old_img_file) {
        unlink($uploadDir . $old_img_file);
    }

    header("Location: ../../../resources/views/events/index.php?msg=Event Deleted&type=deleted");
    exit;
}
?>
