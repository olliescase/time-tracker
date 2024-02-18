<?php

namespace Database\Factories\Roles;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roles\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => null,
            'node' => null
        ];
    }

    /**
     * Specify the node to create a permission for (and guess the name if not already set)
     *
     * @property string $node
     *
     * @return $this
     */
    public function forNode(string $node): static
    {
        return $this->state(
            function (array $attributes) use ($node) {
                $state = ['node' => $node];

                if (!isset($attributes['name'])) {
                    $state['name'] = str($node)->title()->replace('_', ' ')->toString();
                }

                return $state;
            }
        );
    }


    /**
     * Specify the name of the permission (and guess the node if not already set)
     *
     * @property string $name
     *
     * @return $this
     */
    public function withName(string $name): static
    {
        return $this->state(
            function (array $attributes) use ($name) {
                $state = ['name' => $name];

                if (!isset($attributes['node'])) {
                    $state['node'] = str($name)->snake()->toString();
                }

                return $state;
            }
        );
    }
}
