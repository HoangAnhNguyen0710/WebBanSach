<?php

namespace App\Services;

use App\Repositories\PublisherRepository;
use Illuminate\Http\Request;

class PublisherServices
{
    protected $publisherRepository;
    public function __construct()
    {
        $this->publisherRepository = app(PublisherRepository::class);
    }

    public function getAll() {
        return $this->publisherRepository->getAll()->toArray();
    }

    public function getPublisherName($id) {
        return $this->publisherRepository->getPublisherName($id)->toArray()["publisher_name"];
    }
}
