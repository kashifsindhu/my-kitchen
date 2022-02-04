<!-- Update Region Model -->
<div class="modal fade" id="updateState" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update State</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="form">

            </div>
        </div>
    </div>
</div>
<!-- Update Region Model End -->
<!-- Add Region Modal -->
<div class="modal fade" id="addState" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add State</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form action="{{ route('state.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="label-wrapper-custm" for="name">Name <span class="required-star">*</span></label>
                        <input type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" id="state"
                        value="{{ old('name') }}" placeholder="Enter State Name" required>
                        @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 error-placeholder"> 
                        <label class="label-wrapper-custm" for="state_id">Zone <span class="required-star">*</span></label>
                        <select name="zone_id" class="form-control @error('state_id') is-invalid @enderror" id="state_id" required>
                            <option selected disabled>Select Zone</option>
                            @foreach($zones as $zone)                                   
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save & Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Region Modal End-->