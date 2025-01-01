<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniHub - Stream Now</title>
</head>
<body>
<?php
if (!isset($_GET['id'])) {
    die("Anime ID is required.");
}

$id = htmlspecialchars($_GET['id']);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://scappperanime.p.rapidapi.com/anime/$id",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: scappperanime.p.rapidapi.com",
        "X-RapidAPI-Key: a4fe10c0dbmshbf13085ef588865p1cbadajsnadbe42fe8ca0"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    if (isset($data['embed_link'])) {
        $embed_link = "https:" . $data['embed_link'];
        echo '<script>';
        echo 'window.open("' . htmlspecialchars($embed_link) . '", "_blank", "toolbar=no,scrollbars=no,resizable=yes,top=0,left=0,width=100%,height=100%,fullscreen=yes");';
        echo '</script>';
    } else {
        echo 'No embed link found.';
    }
}
?>
</body>
</html>
