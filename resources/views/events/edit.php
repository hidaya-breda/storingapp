<!doctype html>
<html lang="nl">
 
<head>
    <?php
    session_start();
    if(!isset($_SESSION['user_id']) )
    {
        header("Location: login.php");
        exit;
    }
    require_once '../components/head.php'; ?>
</head>
 
<body>
    <?php
 
    if(!isset($_GET['id'])){
        echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
        exit;
 
    }
    ?>
    <?php
        require_once '../components/header.php'; ?>
 
    <div class="container">
        <h1>Event Aanpassen</h1>
 
        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];
 
        //1. Haal de verbinding erbij
        require_once '../../../config/conn.php';
 
        //2. Query, vul deze aan met een WHERE zodat je alleen de event met dit id ophaalt
        $query = "SELECT * FROM events WHERE id = :id";
 
        //3. Van query naar statement
        $statement = $conn->prepare($query);
 
        //4. Voer de query uit, voeg hier nog de placeholder toe
        $statement->execute([
            ":id" => $id
        ]);
 
        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $event =  $statement->fetch(PDO::FETCH_ASSOC);
       
        ?>
 
        <form action= "<?php echo $base_url; ?>/app/Http/Controllers/eventsController.php?action=edit" method="POST" enctype="multipart/form-data">
 
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-input" value="<?php echo $event['title']; ?>">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-input" rows="4"><?php echo $event['description']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="img_file">Image:</label>
                <img src="<?php echo $base_url . "/public_html/img/" . $event['img_file']; ?>" alt="eventsphoto" style="max-width: 120px;">
                <input type="file" name="img_file" id="img_file" class="form-input" value="<?php echo $event['img_file']; ?>">
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
           
            <input type="submit" value="event opslaan">
 
        </form>
 
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/eventsController.php?action=delete" method="POST">
            <input type="hidden" name="action" value="Delete">
            <input type="hidden" name= "id" value= "<?php echo $id;?>">
 
            <input type="submit" value="Verwijder bericht">
        </form>
    </div>  
 
</body>
 
</html>
 