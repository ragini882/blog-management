@extends('ticket.layout')

@section('body')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Ticket</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#ticketModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Ticket</span></a>
                    </div>
                </div>
            </div>
            <div id="ticket_data">
                @include('ticket.ticket_list')
            </div>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<div id="ticketModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submitTicket" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Ticket</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Ticket Type</label>
                        <input type="text" class="form-control" name="issue_type" id="issue_type" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" id="ticket_id" name="ticket_id" value="0">
                    <input type="submit" class="btn btn-success" value="Add" id="btn-save">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Message Modal HTML -->
<div id="messageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submitMessage" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Messages</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="message_data" style="overflow-y: scroll; height: 300px">
                    @include('ticket.message_list')
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="message" id="message" placeholder="Type message" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" id="message_ticket_id" name="ticket_id" value="0">
                    <input type="submit" class="btn btn-success" value="Send" id="btn-send-message">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<!-- <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection