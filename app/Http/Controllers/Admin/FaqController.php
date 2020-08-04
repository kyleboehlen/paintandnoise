<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    }

    public function update(UpdateRequest $reqest)
    {

    }

    public function delete(DeleteRequest $request)
    {

    }

    public function view(ViewRequest $request, $id)
    {

    }
}
