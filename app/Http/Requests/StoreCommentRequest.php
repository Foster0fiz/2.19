<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Определите, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Разрешаем всем пользователям делать запрос
    }

    /**
     * Получите правила валидации, которые должны быть применены к запросу.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
