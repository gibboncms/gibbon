<?php

namespace GibbonCms\Gibbon\System;

trait DefaultPersistence
{
    public $operations = [
        'insert' => [],
        'update' => [],
        'delete' => [],
    ];

    abstract protected function insertEntity($entity);

    abstract protected function updateEntity($entity);

    abstract protected function deleteEntity($entity);

    public function insert($entity)
    {
        $this->operations['insert'][] = $entity;

        return $this;
    }

    public function update($entity)
    {
        $this->operations['update'][] = $entity;

        return $this;
    }

    public function delete($entity)
    {
        $this->operations['delete'][] = $entity;

        return $this;
    }

    public function save()
    {
        // Todo: Make the operations array and workflow a bit more sophisticated

        foreach($operations['insert'] as $entity) $this->insertEntity($entity);
        foreach($operations['update'] as $entity) $this->updateEntity($entity);
        foreach($operations['delete'] as $entity) $this->deleteEntity($entity);

        $this->clean();
    }

    public function clean()
    {
        $this->operations = [
            'insert' => [],
            'update' => [],
            'delete' => [],
        ];
    }
}