<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword, $request->mode)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->paginate(7)
            ->appends($request->all());

        $detail = null;
        if ($request->has('id')) {
            $detail = Contact::with('category')->find($request->id);
        }

        $categories = Category::all();

        return view('admin.dashboard', compact('contacts', 'categories', 'detail'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }


    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword, $request->mode)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->get();

        $fileName = 'contacts_' . date('Ymd') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return new StreamedResponse(function () use ($contacts) {
            $stream = fopen('php://output', 'w');

            stream_filter_append($stream, 'convert.iconv.UTF-8/CP932//TRANSLIT', STREAM_FILTER_WRITE);

            fputcsv($stream, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '内容']);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->last_name . $contact->first_name,
                    $contact->gender_text,
                    $contact->email,
                    $contact->category->content,
                    $contact->detail
                ]);
            }
            fclose($stream);
        }, 200, $headers);
    }
}
