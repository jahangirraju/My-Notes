<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MyNotesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->lang) {
            $locale = $request->lang;
        } else {
            $locale = App::currentLocale();
        }

        if ($locale) {
            App::setLocale($locale);
        }

        if ($request->search)
        {
        // Get the search value from the request
        $search = $request->search;
        $also = '%' . $search . '%';

        // Search in the title and body columns from the posts table
        $notes = Note::where('title', 'like',  $also)
            ->orWhere('detail', 'like', $also)
            //->orderBy('id', 'desc')
            ->paginate(15);
        }else {
            $notes = Note::orderBy('id', 'desc')->paginate(2);
            //orderBy('id', 'desc')->paginate(2);
        }

        return view('mynote.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|max:150',
            'detail'        => 'required',
         ]);
         
        //  foreach ($my_note as $note) {

        //     $notes = Note::where('note', $note)->first();
        //     if (empty($my_note)) {
        //         $notes = new Note();
        //         $notes->title = $note;
        //         $notes->detail = $note;
        //         $notes->save();
        //     }
        //  }
        //  return back();

         
         $note = new Note();
         $note->title = $request->title;
         $note->detail = $request->detail;
         $note->save();
        return back();
    }

    public function edit($id)
    {
       $note = Note::find($id);
       return view('mynote.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'            => 'required|max:150',
            'detail'        => 'required',
   
         ]);

         $note = Note::find($id);
         $note->title = $request->title;
         $note->detail = $request->detail;
         $note->save();
        return back();
    }

    public function delete($id)
    {
        $note = Note::find($id);
        $note->delete();

        session()->flash('success' , 'Product has deleted successfully !!');
        return redirect()->route('notes.index');
    }


}
