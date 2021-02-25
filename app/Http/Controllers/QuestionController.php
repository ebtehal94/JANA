<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuestionAnswered;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        return $questions;
    }

    public function show($id)
    {
        $question = Question::where('id', $id)->get();
        return $question;
    }

    public function create(Request $request)
    {
        $response = array();
        $question = $request->all();
        $request->validate([
            'name'    => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $newQuestion = Question::create($question);

        if($newQuestion) {
            $response['question'] = $newQuestion;
            $response['statusCode']         = 200;
        } else {
            $response['statusCode']     = 400;
            $response['msg']            = 'Ops! Something went wrong..';
        }

        return $response;
    }

    public function update(Request $request)
    {
        $response = array();
        $info     = $request->all();
        $question = Question::find($info['question_id']);

        if($question) {
            $question->update([ 'response' => $info['response'], 'status' => $info['status'] ]);

            $response['question']     = $question;
            $response['statusCode']   = 200;
        } else {
            $response['statusCode']   = 400;
            $response['msg']            = 'Ops! Something went wrong..';
        }

        return $response;
    }

    public function mail(Request $request)
    {
        $response = array();
        $info     = $request->all();
        $question = Question::find($info['id']);

        if($question) {
            $question->update([ 'response' => $info['response'], 'status' => 1 ]);

            Mail::to($info['email'])->send(new QuestionAnswered($info));

            $response['status'] = 200;
            $response['msg'] = 'Email Sent Successfully';
        } else {
            $response['statusCode']   = 400;
            $response['msg']            = 'Ops! Something went wrong..'; 
        }

        return $response;
    }
}
