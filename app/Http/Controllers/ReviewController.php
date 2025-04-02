<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Отобразить список отзывов и форму создания/редактирования.
     */
    public function index(Request $request)
    {
        // Получаем все отзывы из базы
        $reviews = Review::all();

        // Если в запросе есть параметр 'edit', находим отзыв для редактирования
        $editReview = null;
        if ($request->has('edit')) {
            $editReview = Review::find($request->input('edit'));
        }

        // Передаём в представление список отзывов и отзыв для редактирования (если выбран)
        return view('reviews.index', compact('reviews', 'editReview'));
    }

    /**
     * Сохранить новый отзыв.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name'   => 'required|string|max:255',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')->with('success', 'Отзыв успешно добавлен!');
    }

    /**
     * Обновить отзыв.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name'   => 'required|string|max:255',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        return redirect()->route('reviews.index')->with('success', 'Отзыв успешно обновлен!');
    }

    /**
     * Удалить отзыв.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Отзыв успешно удален!');
    }
}
