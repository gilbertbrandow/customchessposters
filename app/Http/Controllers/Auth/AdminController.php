<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function showFaq()
    {
        $faqs = Faq::All();
        return inertia('Auth/EditFaq', compact('faqs')); 
    }

    public function editFaq(Request $request)
    {

        if($request->id == 0) {
            Faq::create(['question' => $request->faq['question'], 'answer' => $request->faq['answer']]);
        }



        return redirect()->back()->with('success', 'FAQ update or created');
    }

}
