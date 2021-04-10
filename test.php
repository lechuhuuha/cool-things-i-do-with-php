<?php
// ini_set(
//     'user_agent',
//     'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3'
// );
function get_client_ip()
{
    // Nothing to do without any reliable information
    if (!isset($_SERVER['REMOTE_ADDR'])) {
        return NULL;
    }

    // Header that is used by the trusted proxy to refer to
    // the original IP
    $proxy_header = "HTTP_X_FORWARDED_FOR";

    // List of all the proxies that are known to handle 'proxy_header'
    // in known, safe manner
    $trusted_proxies = array("2001:db8::1", "192.168.50.1");

    if (in_array($_SERVER['REMOTE_ADDR'], $trusted_proxies)) {

        // Get IP of the client behind trusted proxy
        if (array_key_exists($proxy_header, $_SERVER)) {

            // Header can contain multiple IP-s of proxies that are passed through.
            // Only the IP added by the last proxy (last IP in the list) can be trusted.
            $client_ip = trim(end(explode(",", $_SERVER[$proxy_header])));

            // Validate just in case
            if (filter_var($client_ip, FILTER_VALIDATE_IP)) {
                return $client_ip;
            } else {
                // Validation failed - beat the guy who configured the proxy or
                // the guy who created the trusted proxy list?
                // TODO: some error handling to notify about the need of punishment
            }
        }
    }

    // In all other cases, REMOTE_ADDR is the ONLY IP we can trust.

    return $_SERVER['REMOTE_ADDR'];
}
$ipaddress = $_SERVER['REMOTE_ADDR'];
echo '<br>';
echo "Your IP Address is " . $ipaddress;
echo '<br>';
echo get_client_ip();
echo '<br>';
print_r($_SERVER);

function curl($url)
{
    // Assigning cURL options to an array
    $options = array(

        CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
        CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
        CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
        CURLOPT_HEADER => TRUE,
        CURLOPT_CONNECTTIMEOUT => 1200,   // Setting the amount of time (in seconds) before the request times out
        CURLOPT_TIMEOUT => 1200,  // Setting the maximum amount of time for cURL to execute queries
        CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
        CURLOPT_USERAGENT => "Googlebot/2.1 (+http://www.googlebot.com/bot.html)",  // Setting the useragent
        CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
        CURLOPT_ENCODING => 'gzip,deflate',

    );

    $ch = curl_init();  // Initialising cURL
    curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options

    $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //to check whether any error occur or not
    if ($httpcode != "200") {
        return "error";
    }

    return $data;   // Returning the data from the function
}
$lol = curl('http://st.imageinstant.net/');
print_r($lol);
