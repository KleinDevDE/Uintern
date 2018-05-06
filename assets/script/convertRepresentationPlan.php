<?php
debug();
$endpoint = "https://sandbox.zamzar.com/v1/jobs";
$apiKey = "d847791e20c59a20560b1596e21d82504a552ce7";
$sourceFile = getWebroot()."/assets/files/vertretungsplan/Vertretungsplan.docx";
$targetFormat = "html";
if (md5_file(getRoot()."/assets/files/vertretungsplan/Vertretungsplan.docx") == SQLITE_getSetting("RepresentationPlan_MD5"))
    return;

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
    if ($count == 100)
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
$localFilename = getRoot()."/assets/files/vertretungsplan/converted.zip";
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
    $zip->extractTo(getRoot()."/assets/files/vertretungsplan/");
    $zip->close();
} else {
    throw  new Exception("Error trying unzip converted.zip");
}
unlink(getRoot()."/assets/files/vertretungsplan/converted.zip");

$str=file_get_contents(getRoot()."/assets/files/vertretungsplan/Vertretungsplan.html");
$str=str_replace("src=\"", "src=\"".getWebroot()."/assets/files/vertretungsplan/",$str);
$str=str_replace("<body>", "<body align=\"center\">",$str);
$str=str_replace(";left:", ";margin-left:",$str);
$str=str_replace(";right:", ";margin-right:",$str);
$str=str_replace(";top:", ";margin-top:",$str);
$str=str_replace(";bottom:", ";margin-bottom:",$str);
$str=str_replace(".pos { position: absolute; z-index: 0; left: 0px; top: 0px }", ".pos { position: absolute; z-index: 0; margin-left: 0px; margin-top: 0px }",$str);
file_put_contents(getRoot()."/assets/files/vertretungsplan/Vertretungsplan.html", $str);

SQLITE_setSetting("RepresentationPlan_MD5", md5_file(getRoot()."/assets/files/vertretungsplan/Vertretungsplan.docx"));
