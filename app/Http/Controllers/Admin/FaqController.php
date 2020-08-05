<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

// Models
use App\Models\Faqs;

// Requests
use App\Http\Requests\Admin\Faq\IndexRequest;
use App\Http\Requests\Admin\Faq\CreateRequest;
use App\Http\Requests\Admin\Faq\UpdateRequest;
use App\Http\Requests\Admin\Faq\DeleteRequest;
use App\Http\Requests\Admin\Faq\ViewRequest;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(IndexRequest $request)
    {
        return view('admin.faq');
    }

    public function create(CreateRequest $request)
    {
        // Get admin user for logging
        $user = \Auth::guard('admin')->user();

        // Create new FAQ
        $faq = new Faqs([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // Save new FAQ
        if($faq->save())
        {
            // Log creation
            Log::info("Created new FAQ created by $user->name", [
                'faq_id' => $faq->id,
                'admin_user_id' => $user->id,
            ]);
        }
        else
        {
            // Log failure
            Log::warning("Failed to create new FAQ by $user->name", [
                'question' => $request->question,
                'answer' => $request->answer,
                'admin_user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin.faq');
    }

    public function update(UpdateRequest $request)
    {

    }

    public function delete(DeleteRequest $request)
    {
        // Get admin user for logging
        $user = \Auth::guard('admin')->user();

        // Get FAQ to delete
        $faq = Faqs::find($request->get('faq-id'));

        if($faq->delete())
        {
            // Log deletion
            Log::info("$user->name deleted a FAQ", [
                'faq_id' => $faq->id,
                'admin_user_id' => $user->id,
            ]);
        }
        else
        {
            // Log failure
            Log::warning("$user->name failed to delete a FAQ", [
                'faq_id' => $faq->id,
                'admin_user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin.faq');
    }

    public function view(ViewRequest $request, $id)
    {

    }
}
