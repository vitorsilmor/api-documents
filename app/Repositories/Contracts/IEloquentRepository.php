<?php

namespace App\Repositories\Base;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepository
{
    /**
     * Search for an ID.
     *
     * @param integer $id
     * @return Model|null
     */
    public function get(int $id): ?Model;

    /**
     * Returns all items from a Model.
     *
     * @return Collection|null
     */
    public function getAll(): ?Collection;

    /**
     * Creates a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update a record.
     *
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * Deletes a record.
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool;
}
