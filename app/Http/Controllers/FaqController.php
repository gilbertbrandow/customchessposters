<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::All();
        return Inertia::render('FAQ', compact('faqs'));
    }

    public function edit()
    {
        $faqs = Faq::All();
        return Inertia::render('Auth/Faq', compact('faqs'));
    }


    public function create(Request $request)
    {

        Faq::create(['question' => $request->faq['question'], 'answer' => $request->faq['answer']]);
        return redirect()->back()->with('success', 'FAQ successfully created');
    }


    public function update(Request $request)
    {
        Faq::find($request->faq['id'])->update($request->faq);
        return redirect()->back()->with('success', 'FAQ successfully updated');
    }

    public function destroy(Request $request)
    {

        Faq::find($request->faq['id'])->delete();
        return redirect()->back()->with('success', 'FAQ successfully removed');
    }
}
