<?php
session_start();
if(!isset($_SESSION['user_id']) )
{
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <?php require_once 'resources/views/components/head.php'; ?>
    <?php require_once 'config/conn.php'; ?>
    <link rel="stylesheet" href="public_html/css/slides.css">
    <link rel="stylesheet" href="public_html/css/style.css">


</head>

<body>

    <?php require_once 'resources/views/components/header.php'; ?>


    <?php
    // Fetch all events
    $query = "SELECT * FROM events";
    $statement = $conn->prepare($query);
    $statement->execute();
    $events = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Debugging output
    ?>

    <section class="wrapper section">

    <div class="block-content events">
        <h3>Events</h3>
        <div class="events-wrapper">
            <div class="events-grid-content">
            <?php foreach($events as $eventsItem): ?>
                <div class="events-slide">
                    <div class="slide-info">
                        <div class="image-carousel">
                            <?php foreach($eventsItem['img_file'] as $image): ?>
                                <img class="image" src="public/img/events/<?= $image ?>" alt="<?= $eventsItem['title'] ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="event-slide-text">
                        <h4><?= $eventsItem['title'] ?></h4>
                        <p><?= $eventsItem['date'] ?></p>
                        <button class="slide-button">Lees meer</button>
                    </div>
                    <div class="description hidden">
                        <?= $eventsItem['description'] ?>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
    </section>

    


    <!-- Modal Structure -->
    <div id="modal" class="modal">
        <div class="modal-content">

          <div class="modal-top">
            <h4 id="modal-title"></h4>
            <span class="close">&times;</span>
          </div>

        <div class="modal-info">
          <div class="modal-image">
              <img id="modal-img" src="" alt="">
          </div>
          <div class="modal-text">
              <p id="modal-description"></p>
          </div>
        </div>

        </div>
    </div>

    <!-- Voeg hier de rest van de inhoud toe -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.events-slide');

    slides.forEach(slide => {
        const images = slide.querySelectorAll('.image-carousel img');
        let currentIndex = 0;

        if (images.length > 0) {
            images[currentIndex].classList.add('active');

            slide.addEventListener('click', () => {
                images[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].classList.add('active');
            });
        }

        const button = slide.querySelector('.slide-button');
        if (button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const imageSrc = images[currentIndex].src;
                const title = slide.querySelector('h4').textContent;
                const description = slide.querySelector('.description').innerHTML;
                openModal(imageSrc, title, description);
            });
        }
    });

    // Modal related code
    const modal = document.getElementById("modal");
    const closeBtn = document.querySelector(".modal .close");
    const modalImg = document.getElementById("modal-img");
    const modalTitle = document.getElementById("modal-title");
    const modalDescription = document.getElementById("modal-description");

    function openModal(image, title, description) {
        modal.style.display = "flex"; // Changed from "block" to "flex" if using flexbox
        modalImg.src = image;
        modalTitle.textContent = title;
        modalDescription.innerHTML = description;
    }

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

</script>

</body>
</html>
