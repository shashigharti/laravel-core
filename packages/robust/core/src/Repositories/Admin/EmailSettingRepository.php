<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\EmailSetting;
use Robust\Core\Repositories\Admin\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Admin\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Admin\Traits\SearchRepositoryTrait;


/**
 * Class EmailSettingRepository
 * @package Robust\Core\Repositories
 */
class EmailSettingRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * EmailSettingRepository constructor.
     * @param EmailSetting $model
     */
    public function __construct(EmailSetting $model)
    {
        $this->model = $model;
    }
}