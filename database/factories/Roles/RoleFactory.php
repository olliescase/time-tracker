<?php

namespace Database\Factories\Roles;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roles\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Default',
        ];
    }

    public function withName(string $name): static
    {
        return $this->state(fn () => ['name' => $name]);
    }
}
