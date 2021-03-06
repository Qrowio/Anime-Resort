<?php
$ch = curl_init();

if(isset($_POST['submit'])){
    $name = $_POST['anime'];
    $title = preg_replace('/\s+/', '%20', $name);
}

// JSON REQUEST FOR THE MOST POPULAR ANIME.
curl_setopt($ch, CURLOPT_URL, "https://kitsu.io/api/edge/trending/anime");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch);
$decode = json_decode($output, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Anime Hub - Index</title>
    <link rel="icon" type="image/png" href="./assets/img/logo.png">
    <meta name="description" content="Pull information related to an anime  you are interested in!">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="padding-bottom: 3rem;">
    <header></header><nav class="navbar navbar-light navbar-expand-md py-3">
    
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                <svg class="bi bi-bezier" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
              </span>
                <img class="nav-brand" src="assets/img/logo.png"></img>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1">
        <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <div id="navcol-1" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="https://github.com/Qrowio/Anime-Resort">About</a></li>
                <li class="nav-item"><a class="nav-link" href="https://discord.gg/qrow/">Community</a></li>
            </ul><a href="https://discord.gg/qrow/"><button class="btn navbar-btn" type="button">Discord</button></a>
        </div>
    </div>
</nav>
    <div class="intro-div">
        <h1 class="intro-h1">Anime<span>Resort</span></h1>
        <h1 class="intro-desc">Your home place for finding the latest and greatest anime. Make a search and find all the information you want.<br></h1>
    </div>
    <div class="container" style="margin-top: 5rem;">
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-9 col-xxl-7 offset-xxl-0" style="margin: auto;">
                <form action="anime.php" method="POST">
                <div style="position: relative;"><button class="search-btn" name="submit" type="submit" type="button"><i class="fa fa-search"></i></button><input type="text" name="anime" placeholder="Search Anime...">
                </form>
                    <h1 class="top-h1">Top Searches:<span>One Piece, Demon Slayer, Dragon Ball Z, Erased, One Punch Man, Attack On Titan</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 10rem;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-heading">TRENDING NOW<span>View All</span></h1>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 0.8rem;">
        <div class="row" style="padding: 0px;">
            <?php
            $x = 0;
            while($x < 5){
                echo '<div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">';
                echo '<a style="text-decoration: none!important;"href="./anime.php?anime='. $decode['data'][$x]['attributes']['titles']['en'] . '">';
                echo '<div><img src="'. $decode['data'][$x]['attributes']['posterImage']['original'] .'" width="258" height="408">';
                echo '<h1 class="anime-title">' . $decode['data'][$x]['attributes']['titles']['en'] . '</h1>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                $x++;
            }
            ?>
        </div>
    </div>
    <div class="container" style="margin-top: 10rem;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-heading">MOST POPULAR<span>View All</span></h1>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 0.8rem;">
        <div class="row" style="padding: 0px;">
            <div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">
                <div><img src="assets/img/i.png" width="258" height="408">
                    <h1 class="anime-title">One Piece</h1>
                </div>
            </div>
            <div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">
                <div><img src="assets/img/69.png" width="258" height="408">
                    <h1 class="anime-title">Kawaii dake ja Nai Shikimori...<br></h1>
                </div>
            </div>
            <div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">
                <div><img src="assets/img/68.png" width="258" height="408">
                    <h1 class="anime-title">Lycosis Recoil<br></h1>
                </div>
            </div>
            <div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">
                <div><img src="assets/img/67.png" width="258" height="408">
                    <h1 class="anime-title">Engage Kiss<br></h1>
                </div>
            </div>
            <div class="col-md-3 col-xxl-12 offset-xxl-0 anime-list-col">
                <div><img src="assets/img/65.png" width="258" height="408">
                    <h1 class="anime-title">Spy x Family<br></h1>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>