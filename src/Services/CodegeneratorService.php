<?php

namespace Strappberry\Devkillerinator\Services;

use Illuminate\Support\Facades\Http;

class CodegeneratorService
{
    public function generate(string $endpoint, array $data)
    {
        $config = config('devkillerinator');

        $url = $config['url'] . '/generators/' . $endpoint;
        $token = $config['token'];

        return Http::withHeaders([
            'Authorization' => "Bearer $token",
        ])->post($url, $data);
    }
}
