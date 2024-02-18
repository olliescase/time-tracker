<?php

namespace Database\Seeders\Roles;

use App\Models\Roles\Contracts\NotPermissable;
use App\Models\Roles\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\info;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::allFiles(app_path('Models'));

        foreach ($files as $file) {
            $className = 'App\\Models\\' . str($file->getPath() . '/' . $file->getFilenameWithoutExtension())->after('app/Models/')->replace('/', '\\');
            if (!class_exists($className)) {
                continue;
            }

            $refClass = new \ReflectionClass($className);

            if (!$refClass->isSubclassOf(Model::class) || $refClass->implementsInterface(NotPermissable::class)) {
                continue;
            }

            $modelSnake = str($refClass->getName())->after('App\Models')->replace('\\', '')->snake();

            $this->ensureExists("write_{$modelSnake}");
            $this->ensureExists("read_{$modelSnake}");
            $this->ensureExists("delete_{$modelSnake}");
            $this->ensureExists("admin_{$modelSnake}");
        }
    }

    protected function ensureExists(string $node): void
    {
        if (Permission::where('node', $node)->exists()) {
            return;
        }

        Permission::factory()->forNode($node)->create();
    }
}
