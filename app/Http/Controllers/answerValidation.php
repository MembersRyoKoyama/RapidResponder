<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Validator;
use Auth;

class answerValidation extends Controller
{
    public function __invoke(Request $request)
    {
        $request->flash();
        $inputs = $request->all();
        $id = $request->session()->get('questions_id', -1);
        $messages = [
            'message.required' => 'メッセージを入力してください。',
            'message.max' => 'メッセージは4000字以内で入力してください。'
        ];
        $validator = Validator::make($inputs, ['message' => 'required|max:4000'], $messages);
        if ($validator->fails()) {
            $t = $validator->errors()->messages()['message'];
            return back()->with(['errors' => $t])->withInput();
        }
        if ($id < 0) {
            return redirect('questionList')->with("errors", ["最初からやり直してください"]);
        }
        if (Question::where('id', $id)->first()->staffs_id != Auth::id()) {
            return back()->with("errors", ["権限がありません"]);
        }
        return view('answers/confirmation', ['inputs' => $inputs]);
    }
}
