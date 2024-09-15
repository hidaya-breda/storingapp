<?php
session_start();
if(!isset($_SESSION['user_id']) )
{
    header("Location: login.php");
    exit;
}
?>

<?php require_once '../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <?php require_once '../components/head.php'; ?>
</head>

<body>

    <?php require_once '../components/header.php'; ?>

    <div class="container">
        <h1>Events</h1>
        <a href="create.php">New Event &gt;</a>


        <?php if(isset($_GET['msg'])): ?>
            <div class="msg <?php echo $_GET['type']; ?>">
                <?php echo htmlspecialchars($_GET['msg']); ?>
                <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        <?php endif; ?>

        <?php require_once '../../../config/conn.php'; 
        
        
        $query = "SELECT * FROM events ORDER BY date DESC"; 
        $statement = $conn->prepare($query); 
        $statement->execute(); 
        $events = $statement->fetchAll(PDO::FETCH_ASSOC); 
?>

        <table> 
            <tr> 
                <th>Id</th> 
                <th>title</th>
                <th>description</th>
                <th>img_file</th>
                <th>date</th> 

            </tr> 
            <?php foreach($events as $melding) : ?>  
                <tr> 
                    <td><?php echo $melding['id']; ?></td> 
                    <td><?php echo $melding['title']; ?></td>
                    <td><?php echo $melding['description']; ?></td>
                    <td><?php echo $melding['img_file']; ?></td>
                    <td><?php echo $melding['date']; ?></td>
                    
                    <td><a href="edit.php?id=<?php echo $melding['id']?>">aanpassen</a></td>
                    
                </tr> 
                <?php endforeach; ?> 
            </table>
</body>

</html>
