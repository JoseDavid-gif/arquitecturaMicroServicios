<?php

namespace App\Http\Controllers;

use App\Review;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        //
    }

    public function index()
    {
        $reviews = Review::all();

        return $this->successResponse($reviews);
    }

    public function store(Request $request)
    {
        $rules = [
            'book_id' => 'required|integer|min:1',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'reviewer' => 'max:255',
        ];

        $this->validate($request, $rules);

        $review = Review::create($request->all());

        return $this->successResponse($review, Response::HTTP_CREATED);
    }

    public function show($review)
    {
        $review = Review::findOrFail($review);

        return $this->successResponse($review);
    }

    public function update(Request $request, $review)
    {
        $rules = [
            'book_id' => 'integer|min:1',
            'review' => 'max:65535',
            'rating' => 'integer|min:1|max:5',
            'reviewer' => 'max:255',
        ];

        $this->validate($request, $rules);

        $review = Review::findOrFail($review);

        $review->fill($request->all());

        if ($review->isClean()) {
            return $this->errorResponse('Al menos un atributo debe modificarse', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $review->save();

        return $this->successResponse($review);
    }

    public function destroy($review)
    {
        $review = Review::findOrFail($review);

        $review->delete();

        return $this->successResponse($review);
    }
}
