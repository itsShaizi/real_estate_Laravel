<?php

namespace App\Http\Controllers;

use App\Events\ContactFormSubmitted;
use App\Events\ShowingRequestSubmitted;
use App\Http\Requests\FormSubmissionRequest;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function index()
    {
        $forms = FormSubmission::orderByDesc('created_at')->paginate(20);
        return view('backend.form-submissions', compact('forms'));
    }

    public function store(FormSubmissionRequest $request)
    {
        $formSubmission = FormSubmission::create($request->validated());

        if($formSubmission){
            if($formSubmission->form_submission_type == 'contact'){
                ContactFormSubmitted::dispatch($formSubmission);
            }elseif($formSubmission->form_submission_type == 'schedule_showing'){
                ShowingRequestSubmitted::dispatch($formSubmission);
            }
            return response($formSubmission, 201);
        }else{
            abort(500);
        }
    }
}
