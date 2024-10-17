<?php

namespace Strappberry\Devkillerinator\Commands;

use Illuminate\Console\Command;
use Strappberry\Devkillerinator\Services\CodegeneratorService;

use function Laravel\Prompts\textarea;

class DevkillerinatorLandingCommand extends Command
{
    public $signature = 'dev:landing';

    public $description = 'Genera una landing page para tu proyecto';

    public function handle(): int
    {
        $about = textarea(
            label: 'Cuentanos sobre el proyecto',
            placeholder: 'El proyecto es de facturación con las siguientes características...',
            hint: 'Escribe una descripción del proyecto',
            required: true,
        );

        $landing = file_get_contents(resource_path('views/welcome.blade.php'));

        $data = [
            'layout' => base64_encode($landing),
            'instructions' => $about,
        ];

        $this->info('Generando landing, espere un momento ...');

        $generator = app(CodegeneratorService::class);
        $response = $generator->generate('landing', $data);

        if ($response->failed()) {
            $this->error('No se pudo generar el código');

            return self::FAILURE;
        }

        $body = $response->json();

        file_put_contents(resource_path('views/welcome.blade.php'), $body['data']['landing']);

        $this->info('Landing generado correctamente');

        return self::SUCCESS;
    }
}
