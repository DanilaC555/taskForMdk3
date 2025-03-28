<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Получаем все отзывы из базы
        $reviews = Review::all();

        // Возвращаем представление и передаём туда список отзывов
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Валидируем данные формы
        $request->validate([
            'user_name'   => 'required|string|max:255',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        // Создаём запись в базе
        Review::create($request->all());

        // Возвращаемся на страницу списка отзывов с сообщением об успехе
        return redirect()->route('reviews.index')->with('success', 'Отзыв успешно добавлен!');
    }
}
