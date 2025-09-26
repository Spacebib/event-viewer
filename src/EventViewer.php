<?php

namespace Spacebib\EventViewer;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;

class EventViewer
{
    /**
     * The callback that should be used to authenticate Horizon users.
     *
     * @var Closure
     */
    public static $authUsing;

    public static function check($request)
    {
        return (self::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }

    /**
     * Set the callback that should be used to authenticate Event-Viewer users.
     *
     * @param Closure $callback
     */
    public static function auth(Closure $callback)
    {
        self::$authUsing = $callback;
    }

    public function findByID(int $id)
    {
        return $this
            ->queryBuilder()
            ->find($id);
    }

    public function queryBuilder(): Builder
    {
        $connection = app()['db']->connection($this->getConfig('connection'));

        return $connection->table($this->getConfig('table'));
    }

    public function count(): int
    {
        // Since events are immutable and append-only, MAX(id) gives exact count
        return $this->queryBuilder()->max('id') ?? 0;
    }

    public function getConfig(string $name)
    {
        return config("event-viewer.{$name}");
    }

    public function format($model)
    {
        foreach ($this->getConfig('columns') as $k => $v) {
            $model->{$k} = $model->$v;
        }
        return $model;
    }
}
