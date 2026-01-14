<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ReviewService;
use App\Services\BookService;

class ReviewController extends Controller
{
    use ApiResponser;

    public $reviewService;
    public $bookService;

    public function __construct(ReviewService $reviewService, BookService $bookService)
    {
        $this->reviewService = $reviewService;
        $this->bookService = $bookService;
    }

    public function index()
    {
        return $this->successResponse($this->reviewService->obtainReviews());
    }

    public function store(Request $request)
    {
        // Opcional: Validar si el libro existe antes de enviar al microservicio
        return $this->successResponse($this->reviewService->createReview($request->all()), Response::HTTP_CREATED);
    }

    public function show($review)
    {
        return $this->successResponse($this->reviewService->obtainReview($review));
    }

    public function update(Request $request, $review)
    {
        return $this->successResponse($this->reviewService->editReview($request->all(), $review));
    }

    public function destroy($review)
    {
        return $this->successResponse($this->reviewService->deleteReview($review));
    }
}