<?php

$data = [];

require_once('TwitterAPIExchange.php');
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2745919737-VLf5VTVWl9RNgBuPZZrfTstWYsOUcPiHOCTn3Rh",
    'oauth_access_token_secret' => "Z7Q88SoSxq5Bg6PMyaQ1cnkoCKZ2L6lrMXPG1edNhzixL",
    'consumer_key' => "WHXjn9KCDlBs1gd8VMvtMNtja",
    'consumer_secret' => "A1SUpuGJOBdM0ovck0qHb8D4TGv89VDFdJBBcRosAg5YHPgi0j"
);

/** $url = "https://api.twitter.com/2/users/search.json?q="; **/
$url = "https://api.twitter.com/1.1/users/search.json";

$requestMethod = "GET";

$getfield = '?q=' . urldecode($_GET['searchQuery']); //pass in artist name
// print($getfield);
 
$twitter = new TwitterAPIExchange($settings);
$twitter->setGetfield($getfield)
 ->buildOauth($url, $requestMethod)
 ->performRequest();


$string = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);

if(array_key_exists("errors", $string)) {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
            //  echo "<pre>";
            //  //print_r($string);
            //  echo "</pre>";

$id = $string[0]['id'];
$name = $string[0]['screen_name'];
/*foreach($string as $items)
             {
                 echo "ID: ".$items['id']."<br />";
                 echo "Name: ". $items['screen_name']."<br />";
             } */

$data["name"] = $name;



$url2 = "https://api.twitter.com/2/users/".$id."/tweets";

$getfield2 = '?max_results=10&exclude=retweets,replies';
 
$twitter2 = new TwitterAPIExchange($settings);
 $twitter2->setGetfield($getfield2)
             ->buildOauth($url2, $requestMethod)
             ->performRequest();


$string2 = json_decode($twitter2->setGetfield($getfield2)
             ->buildOauth($url2, $requestMethod)
             ->performRequest(),$assoc = TRUE);

if(array_key_exists("errors", $string2)) {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
            //  echo "<pre>";
            //  //print_r($string2);
            //  echo "</pre>";

$tweets = [];
for ($x = 0; $x < 10; $x++)
             {
                $tweets[] = $string2['data'][$x]['text'];
                 //echo "Name: ". $items['screen_name']."<br />";
             }
             
$data["tweets"] = $tweets;
echo json_encode($data);
?>