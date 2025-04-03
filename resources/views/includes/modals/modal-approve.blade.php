<div id="approveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-h6="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('request.approve')}}" method="post">
                    @csrf

                    <input type="hidden" id="approve-id" name="id" />

                    <div class="form-group">
                        <input class="form-control fw-600 text-success text-center" value="Accept and Authorize Trip" disabled />
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('Email Subject') }}</label>
                        <input class="form-control" type="text" name="subject" value="{{ old('subject', 'Request Approved')  }}" required autocomplete="subject" placeholder="Subject"/>
                    </div>
                    <div class="form-group">
                            <label for="message">{{ __('Message') }}</label>
                            <textarea class="form-control" type="message" name="message" required autocomplete="message" placeholder="Enter Message">This is to inform you that your trip request has been Approved. You can now enjoy without restrictions. Cheers!!</textarea>
                    </div>
                    
                    <div class="form-group float-right mt-3">
                        <button type="submit" class="btn btn-success px-4 border-none">Confirm</button>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>