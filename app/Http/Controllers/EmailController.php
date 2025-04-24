<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class EmailController extends Controller
{
    public function sendMail(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ]
        );
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        // Save the message to the database
        Message::create($details);
        // Send the email
        Mail::to($request->email)->send(new ContactMail($details));

        return back()->with('success', 'Email sent successfully!');
    }
    public function history(Request $request){
        //get search from request
        $search = $request->input('search');

        //define sortField and sortDirection
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        //create query
        $query = Message::query();

        //if any, add search
        if($search){
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
            });

        }
        //use filter
        $query->orderBy($sortField, $sortDirection);

        //deploy query with pagination
        $messages = $query->paginate(5);

        return view('message-history', compact('messages', 'search', 'sortField', 'sortDirection'));
    }

    public function deleteMessage($id){
        //find message by id
        $message = Message::find($id);
        //delete message
        if($message){
            $message->delete();
            return redirect()->back()->with('success', 'Message deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'Message not found!');
        }
    }
    public function showMessage(){
        //get all messages
        $messages = Message::all();
        return view('message-history', compact('messages'));
    }
}
