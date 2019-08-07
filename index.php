<?php
if (!empty($_GET['location'])) {
    
    $maps_url = "https://developers.zomato.com/api/geocode/json/v2.1/search?user-key=d726e7aeae9615ad9733bf7a3ac28586&address=". urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    $lat = $maps_array['location']['lat'];
    $lng = $maps_array['location']['lng'];
    $res_id = $maps_array['location']['res_id'];

 $url = 'https://' .
        'developers.zomato.com/api/v2.1/search?entity_id=14&entity_type=city' .
        '?user-key=d726e7aeae9615ad9733bf7a3ac28586'.'&lat=' . $lat .
        '&lng=' . $lng .
        '&res_id='.$res_id;
    $json = file_get_contents($url);
    $array = json_decode($json, true);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Zomato API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="Zomato_logo.png" class="img-rounded" hight="20" width="50" >
    </div>
  </div>
</nav>
<div class="container-fluid">
<form action="" method="get">
    <div class="form-group">
      <label>Location</label>
      <input type="text" class="form-control" placeholder="Enter location" name="location" >
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<div id="results" data-url="<?php if (!empty($url)) echo $url ?>">
    <?php
    if (!empty($array)) {
        foreach ($array['data'] as $key => $item) {
            echo '<res_id="' . $item['id'] . '" src="' . $item['address']['locality']['url'] . '" alt=""/><br/>';
        }
    }
    ?>
</div>
  


</body>
</html>
