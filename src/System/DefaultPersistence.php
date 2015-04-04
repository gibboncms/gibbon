<?php

namespace GibbonCms\Gibbon\System;

trait DefaultPersistence
{
    public $operations = [
        'insert' => [],
        'update' => [],
        'delete' => [],
    ];

    abstract protected function persistInsert($entity);

    abstract protected function persistUpdate($entity);

    abstract protected function persistDelete($entity);

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

        foreach($operations['insert'] as $entity) $this->persistInsert($entity);
        foreach($operations['update'] as $entity) $this->persistUpdate($entity);
        foreach($operations['delete'] as $entity) $this->persistDelete($entity);

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
