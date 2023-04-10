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

        $message = "Something went wrong"; 

        if($request->faq['id'] == 0) {
            Faq::create(['question' => $request->faq['question'], 'answer' => $request->faq['answer']]);
            $message = "FAQ Created"; 
        } else {
            if($request->faq['delete']){
                Faq::find($request->faq['id'])->delete(); 
                $message = "FAQ Deleted"; 
            } else {
                Faq::find($request->faq['id'])->update(['question' => $request->faq['question'], 'answer' => $request->faq['answer']]);
                $message = "FAQ Updated";  
            }
        }

        return redirect()->back()->with('success', $message);
    }

}
