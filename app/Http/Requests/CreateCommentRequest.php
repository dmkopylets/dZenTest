<?php

declare(strict_types=1);

namespace App\Http\Requests;

class CreateCommentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'article_id' => 'required|integer|exists:articles,id',
            'body' => 'min:3|max:300',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            'article_id' => $this->route('article_id'),
            'comment_id' => $this->route('comment_id')
        ]);
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'User Id is required!',
            'user_id.exists' => 'User with this Id is required!',
            'article_id.required' => 'Article Id is required!',
            'article_id.exists' => 'Article with this Id is required!',
            'body.min' => 'Body (text) of comments Should be Minimum of 3 Character!',
            'body.max' => 'Body (text) of comments Should not be larger than 300 characters!',
        ];
    }
}
