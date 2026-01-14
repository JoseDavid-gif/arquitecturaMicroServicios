<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class ReviewService
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.reviews.base_uri');
        $this->secret = config('services.reviews.secret');
    }

    public function obtainReviews()
    {
        return $this->performRequest('GET', '/reviews');
    }

    public function createReview($data)
    {
        return $this->performRequest('POST', '/reviews', $data);
    }

    public function obtainReview($review)
    {
        return $this->performRequest('GET', "/reviews/{$review}");
    }

    public function editReview($data, $review)
    {
        return $this->performRequest('PUT', "/reviews/{$review}", $data);
    }

    public function deleteReview($review)
    {
        return $this->performRequest('DELETE', "/reviews/{$review}");
    }
}