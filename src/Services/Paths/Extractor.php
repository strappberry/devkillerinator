<?php

namespace Strappberry\Devkillerinator\Services\Paths;

interface Extractor
{
    public function extract(string $commandOutput): array;
}
