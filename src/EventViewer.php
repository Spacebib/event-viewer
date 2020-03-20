<?php

namespace Spacebib\EventViewer;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class EventViewer
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function findByAggregateRootId(string $aggregateRootId)
    {
        return $this
            ->queryBuilder()
            ->where($this->getConfig('columns.aggregate_root_id'), $aggregateRootId)
            ->first();
    }

    public function queryBuilder(): Builder
    {
        $connection = $this->app['db']->connection($this->getConfig('connection'));

        return $connection->table($this->getConfig('table'));
    }

    public function getConfig(string $name)
    {
        return $this->app['config']["event-viewer.{$name}"];
    }

    public function format($model)
    {
        foreach ($this->getConfig('columns') as $k => $v) {
            $model->{$k} = $model->$v;
        }
        return $model;
    }
}
