<?php
$ch = curl_init();
if(($_POST['anime'])){
    $title = $_POST['anime'];
    $title = preg_replace('/\s+/', '%20', $title);
    curl_setopt($ch, CURLOPT_URL, "https://kitsu.io/api/edge/anime/?include=episodes&filter[text]={$title}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $output = curl_exec($ch);
    $decode = json_decode($output, true);

    if(empty($decode['data'][0]['attributes']['titles']['en_us'])){
        $language = $decode['data'][0]['attributes']['titles']['en'];
    } else if(empty($decode['data'][0]['attributes']['titles']['en'])){
        $language = $decode['data'][0]['attributes']['titles']['en_us'];
    } else {
        $language = $decode['data'][0]['attributes']['titles']['en'];
    }

    if(empty($decode['data'][0]['attributes']['endDate'])){
        $endDate = "Airing";
    } else {
        $endDate = $decode['data'][0]['attributes']['endDate'];
    }

    if(empty($decode['data'][0]['attributes']['nsfw'])){
        $nsfw = "False";
    } else {
        $nsfw = "True";
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Anime Hub - <?php echo $language?></title>
    <link rel="icon" type="image/png" href="./assets/img/logo.png">
    <meta name="description" content="Pull information related to an anime  you are interested in!">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <header style="filter: brightness(50%); background: url(&quot;<?php echo $decode['data'][0]['attributes']['coverImage']['original']; ?>&quot;) no-repeat  fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: 100%;"></header><nav class="navbar navbar-light navbar-expand-md py-3">
    
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
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="https://github.com/Qrowio/Anime-Resort">About</a></li>
                <li class="nav-item"><a class="nav-link" href="https://discord.gg/qrow/">Community</a></li>
            </ul><a href="https://discord.gg/qrow/"><button class="btn navbar-btn" type="button">Discord</button></a>
        </div>
    </div>
</nav>
    <div class="container yes">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-3"><img style="max-width: 100%;" src="<?php echo $decode['data'][0]['attributes']['posterImage']['original']; ?>"></div>
            <div class="col">
                <h1 class="anime-name-romaji"><?php echo $decode['data'][0]['attributes']['titles']['en_jp']; ?></h1>
                <h1 class="anime-name-english"><?php echo $language; ?></h1>
                <h1 class="anime-desc"><?php echo $decode['data'][0]['attributes']['synopsis']; ?><br></h1>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-4 col-xxl-3">
                <div class="statistic1-div">
                    <h1 class="statistic1"><span><?php echo $decode['data'][0]['attributes']['popularityRank']; ?></span>&nbsp;Most Popular Anime</h1>
                </div>
                <div class="statistic1-div">
                    <h1 class="statistic1"><span><?php echo $decode['data'][0]['attributes']['ratingRank']; ?></span>&nbsp;Highest Ranked Anime</h1>
                </div>
            </div>
            <div class="col" style="display: block;position: relative;">
                <div class="adiv">
                    <h1 class="statistic1">Status:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($decode['data'][0]['attributes']['status']); ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Type:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($decode['data'][0]['attributes']['subtype']); ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Length:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($decode['data'][0]['attributes']['episodeLength']); ?> Minutes</span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Start:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($decode['data'][0]['attributes']['startDate']); ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Finish:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($endDate);?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Rating:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['averageRating']; ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Age Rating:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['ageRating']; ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Episodes:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['episodeCount']; ?></span></h1>
                </div>
                <div class="adiv">
                    <h1 class="statistic1">Total Length:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['totalLength']; ?> Minutes</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-md-12 col-xxl-3">
                <div class="statistic1-div" style="padding-top: 10px;">
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Anime ID:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['id']; ?></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Type:&nbsp;<span style="color: #b8b8b8;"><?php echo ucfirst($decode['data'][0]['attributes']['subtype']); ?></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Eng:&nbsp;<span style="color: #b8b8b8;"><?php echo $language?></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Ja:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['titles']['ja_jp']; ?><br></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Rating:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['averageRating']; ?><br></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Fav Count:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['favoritesCount']; ?><br></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 1rem;">Popularity:&nbsp;<span style="color: #b8b8b8;"><?php echo $decode['data'][0]['attributes']['popularityRank']; ?><br></span></h1>
                    <h1 class="statistic1" style="margin-bottom: 10px;">NSFW:&nbsp;<span style="color: #b8b8b8;"><?php echo $nsfw ?><br></span></h1>
                </div>
            </div>
            <div class="col" style="display: block;position: relative;"> <iframe width="100%" height="500" style="border-radius: 8px"
src="https://www.youtube.com/embed/<?php echo $decode['data'][0]['attributes']['youtubeVideoId']; ?>">
</iframe> </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>