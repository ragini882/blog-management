<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Issue</th>
            <th>Email</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($tickets) && count($tickets)>0)
        @foreach($tickets as $ticket)
        <tr>
            <td>#{{$ticket->id}}</td>
            <td>{{$ticket->issue_type}}</td>
            <td>{{$ticket->email}}</td>
            <td>{!! $ticket->description !!}</td>
            <td>{{$ticket->created_at}}</td>
            <td>
                <a href="#messageModal" class="message" data-toggle="modal" value="{{$ticket->id}}"><i class="fa fa-comment" data-toggle="tooltip" title="message"></i></a>
                <a href="#ticketModal" class="edit" data-toggle="modal" value="{{$ticket->id}}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" value="{{$ticket->id}}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
            </td>
        </tr>
        @endforeach
        @else
        <h1>No data found.</h1>
        @endif
    </tbody>
</table>
<div class="clearfix" id="pagination">
    {{ $tickets->links("pagination::bootstrap-5") }}
</div>