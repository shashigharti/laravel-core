<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\Schedule;
use Robust\Core\Repositories\Admin\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Admin\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Admin\Traits\SearchRepositoryTrait;


/**
 * Class ScheduleRepository
 * @package Robust\Core\Repositories
 */
class ScheduleRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * ScheduleRepository constructor.
     * @param Schedule $model
     */
    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

}
