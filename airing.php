<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniHub - Popular</title>

    <link rel="stylesheet" href="cards.css">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="hero">
        <nav class="navbar">
        
            <div class="logo">Logo</div>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="cards.php">Most Popular</a></li>
                <li><a href="#">Top Airing</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
            <form method="get" action="search.php">
    <div class="search-container">
        <input type="text" name ="id" placeholder="Search...">
        <button type="submit" name="submit"><i  class="fas fa-search"></i></button>
    </div>
    </form>
        </nav>
        <div class="content">
        </div>
    </div>   

<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://scappperanime.p.rapidapi.com/animes?page=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: scappperanime.p.rapidapi.com",
        "X-RapidAPI-Key: 9b1673717dmsh9a157a9f42471d8p1f7c85jsnce97ad78924d"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    if (isset($data['animes']) && is_array($data['animes'])) {
        echo '<div class="scroll-container">';
        foreach ($data['animes'] as $anime) {
            $title = $anime['title'] ?? 'No Title';
            $poster_path = $anime['poster_path'] ?? 'default.png';
            $date_time = $anime['date_time'] ?? 'Unknown Date';
            $id = $anime['id'];
            echo '<div class="card">';
            echo '<img src="' . htmlspecialchars($poster_path) . '" alt="' . htmlspecialchars($title) . '">';
            echo '<div class="card-body">';
            $link = "stream.php?id=";
            $flink = $link . urlencode($id); // Only urlencode the id part
            echo '<a href="' . $flink . '" target="_blank" class="card-title">' . htmlspecialchars($title) . '</a>';
            echo '<p class="card-text">' . htmlspecialchars($date_time) . '</p>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo 'No anime found.';
    }
}
?>
<video autoplay loop muted plays-inline class="BGvid">
                <source src="image/JJK.webm" type="video/webm">
        </video>

     
</body>
</html>