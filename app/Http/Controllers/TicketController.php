<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    public function index()
    {
        $data = Ticket::orderBy('created_at', 'DESC')->paginate(2);
        return view('ticket.show', ['tickets' => $data]);
    }

    public function ticketList(Request $request)
    {
        $data = Ticket::orderBy('created_at', 'DESC')->paginate(2);
        return view('ticket.ticket_list', ['tickets' => $data]);
    }

    public function ticketAdd(Request $request)
    {
        $data = $request->all();
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } elseif ($request->cookie('ticket_user_id')) {
            $user_id = $request->cookie('ticket_user_id');
        } else {
            $user = User::create([
                'name' => "guest",
                'email' => $data['email'],
                'password' => Hash::make(123456)
            ]);
            $user_id = $user->id;
        }
        unset($data['ticket_id']);
        $data['user_id'] = $user_id;
        $ticket = Ticket::create($data);
        //TODO:have to send email for ticket create confirmation with default password.
        return response()->json($ticket)->withCookie(cookie()->forever('ticket_user_id', $user_id));
    }

    public function ticketEdit($id)
    {
        $data = Ticket::where('id', $id)->first();
        return response()->json($data);
    }

    public function ticketUpdate(Request $request, $id)
    {
        $data = $request->all();
        $ticket = Ticket::find($id);
        $ticket->issue_type = $request->issue_type;
        $ticket->description = $request->description;
        $ticket->save();
        // $link['can_edit'] = $user->can('blog-edit');
        // $link['can_delete'] = $user->can('blog-delete');
        return response()->json($ticket);
    }

    public function messageList($ticket_id)
    {
        $data = Message::where('ticket_id', $ticket_id)->get();
        return view('ticket.message_list', ['messages' => $data]);
    }

    public function messageAdd(Request $request)
    {
        $data = $request->all();
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } elseif ($request->cookie('ticket_user_id')) {
            $user_id = $request->cookie('ticket_user_id');
        }
        $data['user_id'] = $user_id;
        $message = Message::create($data);
        return response()->json($message);
    }
}
