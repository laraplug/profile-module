<?php

namespace Modules\Profile\Repositories\Eloquent;

use Modules\Profile\Repositories\ProfileRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProfileRepository extends EloquentBaseRepository implements ProfileRepository
{

    /**
     * @inheritDoc
     */
    public function create($data)
    {
        $model = $this->model->newInstance($data);
        $model->user_id = $data['user_id'];
        $model->save();
        return $model;
    }

}
