<?php
$url = 'https://www.urspringschule.de/de/downloads/pdf/sonstige_downloads/speiseplaene/';
$file_1 = 'Speiseplan_KW_'.date('W').'_'.date('y').'.pdf';
$file_2 = 'Speiseplan_KW_'.date('W').'.pdf';
$file_3 = 'Speiseplan_KW_'.date('W').'_'.date('Y').'.pdf';

if (URLexists($url.$file_1))
    $sourceFile = $url.$file_1;
elseif (URLexists($url.$file_2))
    $sourceFile = $url.$file_2;
elseif (URLexists($url.$file_3))
    $sourceFile = $url.$file_3;
else return;

if (file_exists(getRoot()."/assets/files/mensa/".$file_1) || file_exists(getRoot()."/assets/files/mensa/".$file_2) || file_exists(getRoot()."/assets/files/mensa/".$file_3))
    return;

delete_old_files(getRoot()."/assets/files/mensa/", 6, time());
file_put_contents(getRoot().$file_1, fopen($sourceFile, 'r'));

$endpoint = "https://sandbox.zamzar.com/v1/jobs";
$apiKey = "d847791e20c59a20560b1596e21d82504a552ce7";
$targetFormat = "html";

$postData = array(
    "source_file" => $sourceFile,
    "target_format" => $targetFormat
);

$ch = curl_init(); // Init curl
curl_setopt($ch, CURLOPT_URL, $endpoint); // API endpoint
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":"); // Set the API key as the basic auth username
$body = curl_exec($ch);
curl_close($ch);

$response = json_decode($body, true);
//====================
$job = null;

$jobID = $response['id'];
$endpoint = "https://sandbox.zamzar.com/v1/jobs/$jobID";
$apiKey = "d847791e20c59a20560b1596e21d82504a552ce7";

$ch = curl_init(); // Init curl
curl_setopt($ch, CURLOPT_URL, $endpoint); // API endpoint
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":"); // Set the API key as the basic auth username
$body = curl_exec($ch);
curl_close($ch);
$job = json_decode($body, true);
$count = 0;

while ($job['status'] != "successful"){
    $count++;
    if ($count == 300)
        exit;
    if ($count % 10){
        $jobID = $response['id'];
        $endpoint = "https://sandbox.zamzar.com/v1/jobs/$jobID";
        $apiKey = "d847791e20c59a20560b1596e21d82504a552ce7";

        $ch = curl_init(); // Init curl
        curl_setopt($ch, CURLOPT_URL, $endpoint); // API endpoint
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
        curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":"); // Set the API key as the basic auth username
        $body = curl_exec($ch);
        curl_close($ch);
        $job = json_decode($body, true);
    }
}

$fileID = $job['target_files']['1']['id'];
$localFilename = getRoot()."/assets/files/mensa/mensa.zip";
$endpoint = "https://sandbox.zamzar.com/v1/files/$fileID/content";
$apiKey = "d847791e20c59a20560b1596e21d82504a552ce7";

$ch = curl_init(); // Init curl
curl_setopt($ch, CURLOPT_URL, $endpoint); // API endpoint
curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":"); // Set the API key as the basic auth username
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$fh = fopen($localFilename, "wb");
curl_setopt($ch, CURLOPT_FILE, $fh);

$body = curl_exec($ch);
curl_close($ch);

$zip = new ZipArchive;
$res = $zip->open($localFilename);
if ($res === TRUE) {
    $zip->renameIndex(1, "mensa.html");
    $zip->close();
    $res = $zip->open($localFilename);
    if ($res === TRUE) {
        $zip->extractTo(getRoot() . "/assets/files/mensa/");
        $zip->close();
    } else {
        throw  new Exception("Error trying unzip converted.zip");
    }
} else {
    throw  new Exception("Error trying rename file in mensa.zip");
}
unlink(getRoot()."/assets/files/mensa/mensa.zip");

$str=file_get_contents(getRoot()."/assets/files/mensa/mensa.html");
$str=str_replace("src=\"", "src=\"".getWebroot()."/assets/files/mensa/",$str);
$str=str_replace("<body>", "<body align=\"center\">",$str);
$str=str_replace(";left:", ";margin-left:",$str);
$str=str_replace(";right:", ";margin-right:",$str);
$str=str_replace(";top:", ";margin-top:",$str);
$str=str_replace(";bottom:", ";margin-bottom:",$str);
$str=str_replace("<div id=\"page1-div\" style=\"position:relative;", "<div id=\"page1-div\" style=\"position:absolute;",$str);
$str=str_replace("alt=\"background image\"/>", "alt=\"background image\" style=\"position: absolute\"/>",$str);
file_put_contents(getRoot()."/assets/files/mensa/mensa.html", $str);

file_put_contents(getRoot()."/assets/files/mensa/".$file_1, fopen($sourceFile, 'r'));