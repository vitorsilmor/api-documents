<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository
{
    /**
     * Model
     *
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Search for an ID.
     *
     * @param integer $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        $item = $this->model->setConnection('mysql_read')->find($id);

        if (!isset($item->id)) return null;

        return $item;
    }

    /**
     * Returns all items from a Model.
     *
     * @return Collection|null
     */
    public function getAll(): ?Collection
    {
        $itens = $this->model->setConnection('mysql_read')->all();

        if (count($itens) == 0) return null;

        return $itens;
    }

    /**
     * Creates a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $item = $this->model->setConnection('mysql')->create($data);

        if (!isset($item->id))
            throw new \Exception("Unable to insert record. Data" . json_encode([
                'data' => $data
            ]));

        return $item;
    }

    /**
     * Get data with conditions.
     *
     * @param array $data
     * @return Model
     */
    public function getOneWhere(array $data): Model
    {
        $item = $this->model->setConnection('mysql')
            ->where($data)
            ->first();

        return $item;
    }

    /**
     * Update a record.
     *
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        $item = $this->get($id);

        if (is_null($item))
            throw new \Exception("Record doesnt exists.");

        $retorno = $this->model->setConnection('mysql')
            ->where(['id' => $id])
            ->update($data);

        if (!$retorno)
            throw new \Exception("Theres an error to update the register. Data: " . json_encode(
                [
                    'table_name' => $this->model->getTable(),
                    'id' => $id,
                    'data' => $data
                ]
            ));

        return $this->get($item->id);
    }

    /**
     * Deletes a record.
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $item = $this->get($id);

        if (is_null($item))
            throw new \Exception("Record doesnt exists");

        return $this->model->setConnection('mysql')->whereId($id)->delete($id);
    }
}
