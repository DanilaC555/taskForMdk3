<!-- resources/views/reviews/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Отзывы</title>
</head>
<body>

    <h1>Оставить отзыв</h1>

    <!-- Блок для вывода ошибок валидации -->
    @if ($errors->any())
        <div style="color: red;">
            <strong>Ошибка!</strong> Проверьте вводимые данные.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Форма для добавления отзыва -->
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

    <hr>

    <h2>Список отзывов</h2>

    <!-- Вывод сообщения об успехе, если отзыв добавлен -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Перебираем все отзывы и выводим -->
    @foreach ($reviews as $review)
        <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
            <strong>{{ $review->user_name }}</strong> (Рейтинг: {{ $review->rating }})<br>
            {{ $review->review_text }}
        </div>
    @endforeach

</body>
</html>
