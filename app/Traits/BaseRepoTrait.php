<?php

namespace App\Traits;

trait BaseRepoTrait {
    /**
     * 新增
     *
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function insert($params)
    {
        $className = get_class($this->model);
        $model = new $className;
        foreach ($params as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /**
     * 修改
     *
     * @param int $id
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update($id, $params)
    {
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new \Exception('Object not exist');
        }

        foreach ($params as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }

    /**
     * 刪除 (一般做軟刪除)
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}