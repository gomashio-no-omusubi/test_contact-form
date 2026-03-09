<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'detail',
        ]);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $genderLabels = ['1' => '男性', '2' => '女性', '3' => 'その他'];
        $gender_text = $genderLabels[$request->gender] ?? '未設定';

        $category = Category::find($request->category_id);
        $category_name = $category ? $category->content : '未選択';

        return view('contact.confirm', compact('contact', 'gender_text', 'category_name'));
    }

    public function store(Request $request)
    {
        if ($request->input('action') === 'back') {
            return redirect('/')->withInput();
        }
        $contact = $request->only(
            [
                'category_id',
                'first_name',
                'last_name',
                'gender',
                'email',
                'tel1',
                'tel2',
                'tel3',
                'address',
                'building',
                'detail',
            ]
        );
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        Contact::create($contact);
        return redirect('/thanks');
    }
}
