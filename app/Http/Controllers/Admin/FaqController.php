<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use Session;

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
        return view('admin.faq')->with(['show' => 'index']);
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
            // Flash alert
            Session::flash('created-faq', true);

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
        // Get admin user for logging
        $user = \Auth::guard('admin')->user();

        // Hydrate FAQ and update properties from request
        $faq = Faqs::find($request->get('faq-id'));
        $faq->fill($request->all());

        // Save FAQ updates
        if($faq->save())
        {
            // Flash alert
            Session::flash('updated-faq', true);

            // Log update
            Log::info("FAQ updated by $user->name", [
                'faq_id' => $faq->id,
                'admin_user_id' => $user->id,
            ]);
        }
        else
        {
            // Log failure
            Log::warning("Failed to update FAQ by $user->name", [
                'question' => $request->question,
                'answer' => $request->answer,
                'admin_user_id' => $user->id,
            ]);
        }
        
        return redirect()->route('admin.faq');
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
            // Flash alert
            Session::flash('failed-deletion', true);

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
        // Get FAQ
        $faq = Faqs::find($id);

        // Back to index if ID is invalid
        if(is_null($faq))
        {
            return redirect()->route('admin.faq');
        }

        // Return view page
        return view('admin.faq')->with([
            'faq' => $faq,
            'show' => 'view',
        ]);
    }
}
