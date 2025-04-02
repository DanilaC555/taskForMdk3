<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Отзывы</title>
</head>
<body>

    <!-- Если передан отзыв для редактирования, показываем форму редактирования -->
    @if(isset($editReview))
        <h1>Редактировать отзыв</h1>
        <form action="{{ route('reviews.update', $editReview->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="user_name">Ваше имя:</label><br>
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name', $editReview->user_name) }}" required>
            </div>
            <div>
                <label for="rating">Рейтинг (1-5):</label><br>
                <input type="number" name="rating" id="rating" min="1" max="5" value="{{ old('rating', $editReview->rating) }}" required>
            </div>
            <div>
                <label for="review_text">Отзыв:</label><br>
                <textarea name="review_text" id="review_text" required>{{ old('review_text', $editReview->review_text) }}</textarea>
            </div>
            <button type="submit">Обновить отзыв</button>
        </form>
        <!-- Ссылка для отмены редактирования -->
        <p><a href="{{ route('reviews.index') }}">Отмена редактирования</a></p>
    @else
        <!-- Форма для добавления нового отзыва -->
        <h1>Оставить отзыв</h1>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <div>
                <label for="user_name">Ваше имя:</label><br>
                <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" required>
            </div>
            <div>
                <label for="rating">Рейтинг (1-5):</label><br>
                <input type="number" name="rating" id="rating" min="1" max="5" value="{{ old('rating') }}" required>
            </div>
            <div>
                <label for="review_text">Отзыв:</label><br>
                <textarea name="review_text" id="review_text" required>{{ old('review_text') }}</textarea>
            </div>
            <button type="submit">Отправить отзыв</button>
        </form>
    @endif

    <hr>

    <h2>Список отзывов</h2>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Перебираем все отзывы и выводим их с кнопками "Редактировать" и "Удалить" -->
    @foreach ($reviews as $review)
        <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
            <strong>{{ $review->user_name }}</strong> (Рейтинг: {{ $review->rating }})<br>
            <p>{{ $review->review_text }}</p>
            <!-- Ссылка для перехода в режим редактирования на той же странице -->
            <a href="{{ route('reviews.index', ['edit' => $review->id]) }}">Редактировать</a>
            <!-- Форма для удаления отзыва -->
            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить отзыв?')">Удалить</button>
            </form>
        </div>
    @endforeach

</body>
</html>
