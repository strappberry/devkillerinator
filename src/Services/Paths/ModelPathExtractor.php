<?php

namespace Strappberry\Devkillerinator\Services\Paths;

class ModelPathExtractor implements Extractor
{
    public function extract(string $commandOutput): array
    {
        $paths = [
            'model' => '',
            'migration' => '',
            'factory' => '',
        ];

        $patterns = [
            'model' => '/Model \[(.*)\] created successfully./',
            'migration' => '/Migration \[(.*)\] created successfully./',
            'factory' => '/Factory \[(.*)\] created successfully./',
            // 'test' => '/Test \[(.*)\] created successfully./',
        ];

        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $commandOutput, $matches)) {
                $paths[$key] = $matches[1];
            }
        }

        return $paths;
    }
}
