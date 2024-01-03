<?php

declare(strict_types=1);

namespace App\Http\Requests;

class CreateCommentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'user_id'  => 'required|integer',
            'article_id'  => 'required|integer',
            'body'  => 'required|string',
            'target_amount'  => 'required|between:0.01,9999999.99',
            'link'  => 'required|string',
            'completed' => 'integer|between:0,1'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'User id is required!',
            'article_id.required' => 'Article id is required!',
            'body.required' => 'Body (text) of comments is required!',
            'target_amount.required' => 'Target amount is required!',
            'link.required' => 'Link is required!',
        ];
    }
}
