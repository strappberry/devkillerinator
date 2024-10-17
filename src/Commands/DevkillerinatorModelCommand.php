<?php

namespace Strappberry\Devkillerinator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Strappberry\Devkillerinator\Services\CodegeneratorService;
use Strappberry\Devkillerinator\Services\Paths\ModelPathExtractor;

use function Laravel\Prompts\textarea;

class DevkillerinatorModelCommand extends Command
{
    public $signature = 'dev:model';

    public $description = 'Genera un modelo para tu proyecto';

    public function handle(): int
    {
        $about = textarea(
            label: 'Cuentanos sobre el modelo',
            placeholder: 'El modelo será para clientes y tendrá los campos...',
            hint: 'Escribe una descripción del modelo',
            required: true,
        );

        $this->info('Generando modelo, espere un momento...');

        $generator = app(CodegeneratorService::class);
        $response = $generator->generate('model', [
            'instructions' => $about,
        ]);

        if ($response->failed()) {
            $this->error('No se pudo generar el modelo');

            return self::FAILURE;
        }

        $data = $response->json();

        Artisan::call('make:model', [
            'name' => $data['data']['model'],
            '-m' => true,
            '-f' => true,
        ]);

        $pathExtractor = app(ModelPathExtractor::class);
        $paths = $pathExtractor->extract(Artisan::output());

        $this->line('Escribiendo modelo.');
        file_put_contents(base_path($paths['model']), $data['data']['model_file']);
        $this->line('Escribiendo factory.');
        file_put_contents(base_path($paths['migration']), $data['data']['migration_file']);
        $this->line('Escribiendo migration.');
        file_put_contents(base_path($paths['factory']), $data['data']['factory_file']);

        $this->info('Modelo generado exitosamente.');

        return self::SUCCESS;
    }
}
