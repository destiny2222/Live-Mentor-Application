
<!-- MODAL EFFECTS -->
<div class="modal fade" id="modaldemo8-{{ $Application->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.session', $Application->id ) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Sessions Title</label>
                        <input type="text" name="session_title" value="{{ $Application->session_title }}" pleaceholder="" class="form-control @error('session_title') in-valid @enderror">
                        @error('session_title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sessions Mintue</label>
                        <input type="text" name="session_time" pleaceholder="" value="{{ $Application->session_time }}" class="form-control @error('session_time') in-valid @enderror">
                        @error('session_time') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sessions Price</label>
                        <input type="text" name="session_price" pleaceholder="" value="{{ $Application->session_price }}" class="form-control @error('session_time') in-valid @enderror">
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary w-100" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>