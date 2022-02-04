<form action="{{route('state.update',[$warestates->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="mb-3 error-placeholder">
            <label class="label-wrapper-custm" for="name">Name <span class="required-star">*</span></label>
            <input type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
            value="{{$warestates->name}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 error-placeholder"> 
            <label class="label-wrapper-custm" for="zone_id">Warehouse <span class="required-star">*</span></label>
            <select name="zone_id" class="form-control @error('zone_id') is-invalid @enderror" id="zone_id" >
                <option selected disabled>Select Warehouse</option>
                @foreach($zones as $zone)                                        
                    <option value="{{$zone->id}}"
                    {{$warestates->zone_id == $zone->id ? "selected":""}}>{{$zone->name}}</option>
                @endforeach
            </select>
            @error('zone_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update Changes</button>
    </div>
</form>