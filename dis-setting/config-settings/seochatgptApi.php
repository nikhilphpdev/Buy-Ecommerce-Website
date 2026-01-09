<?php
$apiKey = "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";

$productName = 'SIMPARTE Plastic Turkish Basket with Lid for Kitchen';
$prompt = "Generate an SEO-friendly title, meta description, and keywords for an eCommerce product page. 
           The product is '.$productName.'. Include popular keywords related to the product, focus on high search volume phrases, 
           and create a title that improves search engine ranking.";

// Prepare the OpenAI API request
$data = array(
    "model" => "gpt-3.5-turbo",
    "messages" => array(
        array("role" => "system", "content" => "You are an SEO expert."),
        array("role" => "user", "content" => $prompt)
    ),
    "max_tokens" => 100,
    "temperature" => 0.7
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\nAuthorization: Bearer " . $apiKey . "\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true 
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents('https://api.openai.com/v1/chat/completions', false, $context);

if ($result === FALSE) {
    die("Error in API request.");
}

// Decode the response to extract the generated SEO data
$response = json_decode($result, true);

if (isset($response['choices'][0]['message']['content'])) {
    $seoContent = $response['choices'][0]['message']['content'];
    
    $parts = explode("\n", $seoContent);

    // Initialize variables
    $seoTitle = '';
    $seoDescription = '';
    $seoKeyword = '';

    foreach ($parts as $part) {
        if (strpos($part, 'Title:') !== false) {
            preg_match('/Title:\s*(?:"([^"]+)"|([^\n]+))/', $part, $match);
            $seoTitle = $match[1] ?? $match[2] ?? '';
        }

        if (strpos($part, 'Description:') !== false) {
            preg_match('/Description:\s*(?:"([^"]+)"|([^\n]+))/', $part, $match);
            $seoDescription = $match[1] ?? $match[2] ?? '';
        }

        if (strpos($part, 'Keywords:') !== false) {
            preg_match('/Keywords:\s*(?:"([^"]+)"|([^\n]+))/', $part, $match);
            $seoKeyword = $match[1] ?? $match[2] ?? '';
        }
    }

    // Output the SEO content after parsing
   /* echo 'Title: ' . htmlspecialchars($seoTitle) . '<br>';
    echo 'Meta Description: ' . htmlspecialchars($seoDescription) . '<br>';
    echo 'Keywords: ' . htmlspecialchars($seoKeyword) . '<br>';
    
    die;*/
}
?>
