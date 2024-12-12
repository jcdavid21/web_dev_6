<?php

require "../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\resources\parts\TextPart;

// Set header to return JSON
header('Content-Type: application/json');

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Check if input data is valid JSON
if (!$rawData || !$data = json_decode($rawData)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON input."]);
    exit;
}

// Validate the 'text' property
if (empty($data->text) || !is_string($data->text)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing or invalid 'text' field in input JSON."]);
    exit;
}

// Assign the text property
$text = $data->text;

// Initialize the Gemini client
$client = new Client("AIzaSyAldq2qPqGTR5oH6UQ4WAwO3qGLQa0jOIQ");

try {
    // Generate content
    $response = $client->geminiPro()->generateContent(
        new TextPart($text)
    );

    // Clean up the response text
    $cleanedText = str_replace(["\n"], "<br>", $response->text());
    $cleanedText = str_replace("**", "", $cleanedText);
    $cleanedText = str_replace("*", "", $cleanedText);

    // Return the response as JSON
    echo json_encode(["text" => $cleanedText]);
} catch (Exception $e) {
    // Handle exceptions and provide meaningful error messages
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}