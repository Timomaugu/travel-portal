<div id="rejectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-h6="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('request.reject')}}" method="post">
                    @csrf

                    <input type="hidden" id="reject-id" name="id" />

                    <div class="form-group">
                        <input class="form-control fw-600 text-danger text-center" value="Reject and Remain Unauthorized" disabled />
                    </div>
                    <div class="form-group">
                        <label for="subject" >{{ __('Email Subject') }} </label>
                        <input class="form-control" type="text" name="subject"  value="{{ old('subject', 'Request Declined') }}" placeholder="Subject" required autofocus autocomplete="subject" />
                    </div>
                    <div class="form-group">
                        <label for="message">{{ __('Message') }} </label>
                        <textarea class="form-control" type="message" name="message" required autocomplete="message" placeholder="Enter Message">This is to inform you that your trip request has been declined. Contact your dept admin for more info. Regards</textarea>
                    </div>
                    <div class="float-right mt-2">
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>