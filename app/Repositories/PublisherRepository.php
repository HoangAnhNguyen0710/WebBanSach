<?php

namespace App\Repositories;

use App\Models\Publisher;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class PublisherRepository extends BaseRepository {
    public function model() {
        return Publisher::class;
    }

    public function getAll() {
        return $this->model::query()->get('id')->toArray();
    }
}
