<?php

namespace App\Library;

use App\Models\Audit as AuditLog;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Arr;

class Audit
{
    const CREATED = 'created';
    const UPDATED = 'updated';

    protected array $changes;
    protected array $originalData = [];

    protected array $expect = ['created_at',  'updated_at', 'deleted_at'];

    public function __construct(
        protected readonly object $model,
        protected readonly User|Authenticatable|null $user,
        protected readonly string $action
    ){
        $this->changes = Arr::except($this->model->getChanges(), $this->expect);
        $this->setOriginalData();
    }

    private function setOriginalData(): void
    {
        if ($this->action == self::CREATED) {
            $this->originalData = Arr::except($this->model->getAttributes(), $this->expect);
        }

        if ($this->action == self::UPDATED) {
            $this->originalData = Arr::except($this->model->getOriginal(), $this->expect);
        }
    }

    public function execute(): void
    {
        AuditLog::create($this->mountData());
    }

    private function mountData(): array
    {
        return [
            'model' => get_class($this->model),
            'model_id' => $this->model->id,
            'table' => $this->model->getTable(),
            'user_id' => $this->user->id ?? null,
            'original_attributes' => $this->originalData,
            'after_change' => $this->changes,
            'action' => $this->action
        ];
    }

}
