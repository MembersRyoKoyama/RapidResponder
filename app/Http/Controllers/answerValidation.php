<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class answerValidation extends Controller
{
    public function __invoke(Request $request)
    {
        $request->flash();
        $inputs = $request->all();
        $messages = [
            'message.required' => 'メッセージを入力してください。',
            'message.max' => 'メッセージは4000字以内で入力してください。'
        ];
        $validator = Validator::make($inputs, ['message' => 'required|max:4000'], $messages);
        if ($validator->fails()) {
            $t = $validator->errors()->messages()['message'];
            return back()->with(['errors' => $t])->withInput();
        }
        return view('answers/confirmation', ['inputs' => $inputs]);
    }
}
