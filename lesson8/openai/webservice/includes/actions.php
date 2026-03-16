<?php

/**
 * @param string $apiUrl
 * @return array
 * @link @link https://platform.openai.com/docs/api-reference/models
 */
function getModels(string $apiUrl): array
{
    return apiRequest('GET', $apiUrl);
}

/**
 * @param string $apiUrl
 * @param string $question
 * @return array
 * @link https://platform.openai.com/docs/api-reference/chat/create
 */
function getChatCompletions(string $apiUrl, string $question): array
{
    $data = [
        'model' => 'gpt-4o',
        'messages' => [
            [
                'role' => 'user',
                'content' => $question
            ]
        ],
        'temperature' => 0.7
    ];

    return apiRequest('POST', $apiUrl, $data);
}

/**
 * @param string $apiUrl
 * @param string $prompt
 * @return array
 * @link https://platform.openai.com/docs/api-reference/images/create
 */
function getGeneratedImages(string $apiUrl, string $prompt): array
{
    $data = [
        'model' => 'dall-e-3',
        'prompt' => $prompt,
        'n' => 1,
        'size' => '1792x1024',
        'response_format' => 'b64_json'
    ];

    return apiRequest('POST', $apiUrl, $data);
}

/**
 * @param string $method
 * @param string $apiUrl
 * @param array $data
 * @return object|array
 */
function apiRequest(string $method, string $apiUrl, array $data = []): object|array
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . API_KEY
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => ['message' => curl_error($ch)]];
    }
    curl_close($ch);
    return json_decode($response, true);
}
