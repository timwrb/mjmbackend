<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactRequest;

class ContactRequestController extends Controller
{
    public function store(Request $request)
    {
        $contactRequest = new ContactRequest;
        $contactRequest->fill($request->all());
        $contactRequest->save();

        return response()->json($contactRequest, 201);
    }
}
