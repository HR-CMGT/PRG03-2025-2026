<?php
//Redirect
//header("Location: http://nu.nl");
//exit;

//Force (PDF) Download
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="downloaded.pdf"');
//readfile('original.pdf');

//Disable caching for page
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

//Set specific status code to browser
http_response_code(200);

$artists = [
    ['name' => 'Ome Henkie', 'album' => 'De laatste ronde'],
    ['name' => 'Henk Wijngaard', 'album' => 'Met de vlam in de pijp'],
    ['name' => 'Corry en de Rekels', 'album' => 'Huilen is voor jou te laat'],
    ['name' => 'Nico Haak', 'album' => 'Er valt een traan in mijn bier'],
    ['name' => 'Koos Alberts', 'album' => 'Ik verscheurde je foto']
];

//Set type to JSON
header("Content-Type: application/json");
echo json_encode($artists);
exit;
