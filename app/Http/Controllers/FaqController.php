<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function show() {
        $faqs = Faq::All();
        return inertia('FAQ', compact('faqs'));
    }


    public function create(Request $request) {



    }   


    public function update(Request $request) {

    }

    public function destroy($id) {

    }
}
