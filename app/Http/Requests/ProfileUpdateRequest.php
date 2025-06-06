<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string', 
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'username' => [
                'nullable', 
                'string', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'birthday' => ['nullable', 'date', 'before:today'],
            'about_me' => ['nullable', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'game_interests' => ['nullable', 'array'],
            'game_interests.*' => ['exists:game_interests,id'],
        ];
    }
}