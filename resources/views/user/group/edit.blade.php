@extends('layouts.master') 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Edit Group Session</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sessions</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <form action="{{ route('cohort.update', $group->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Add PUT method for updating -->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Group Session</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Session Title" value="{{ old('title', $group->title) }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <!-- Topic Expertise Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Topic Expertise <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="topic_expertise" placeholder="Your expertise in this topic" value="{{ old('topic_expertise', $group->topic_expertise) }}" required>
                            @error('topic_expertise')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <!-- Start Time Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Start Time <span class="text-red">*</span></label>
                                <input type="datetime-local" class="form-control" name="start_time" value="{{ $group->start_time->format('Y-m-d\TH:i') }}" required>
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <!-- End Time Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">End Time <span class="text-red">*</span></label>
                                <input type="datetime-local" class="form-control" name="end_time" value="{{ old('end_time', $group->end_time->format('Y-m-d\TH:i')) }}" required>
                            @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="is_paid">Session Type</label>
                                <select name="is_paid" id="is_paid"  class="form-control">
                                    <option value="0" {{ $group->is_paid == 0 ? 'selected' : '' }}>Free</option>
                                    <option value="1" {{ $group->is_paid == 1 ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                        </div>
                        <div id="price-group" class="form-group" style="display: none;">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" value="{{ $group->price }}" id="price" class="form-control" placeholder="Enter price">
                        </div>
                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description <span class="text-red">*</span></label>
                                <textarea class="form-control" name="description" rows="4" required>{{ old('description', $group->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <!-- Interest Areas Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Interest Areas <span class="text-red">*</span></label>
                                <input type="text" id="interest-areas-input" class="form-control" placeholder="Type an interest area and press Enter">
                                <div id="interest-areas-tags" class="mt-2">
                                    <!-- Show existing tags -->
                                    @if (old('interest_areas', $group->interest_areas))
                                        @foreach (json_decode(old('interest_areas', $group->interest_areas)) as $area)
                                            <span class="badge bg-primary me-2 mb-2">{{ $area }}<span class="ms-2 cursor-pointer">×</span></span>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="hidden" name="interest_areas[]" id="interest-areas-hidden" value="{{ old('interest_areas', $group->interest_areas) }}">
                            </div>
                            @error('interest_areas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status <span class="text-red">*</span></label>
                                <select class="form-control form-select" name="status" required>
                                    <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Open</option>
                                    <option value="2" {{ $group->status == 2 ? 'selected' : '' }}>Closed</option>
                                    <option value="3" {{ $group->status == 3 ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if($group->image)
                                <img src="{{ $group->image }}" alt="Session Image" class="img-fluid mt-2" style="max-width: 150px;">
                            @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update Group Session</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('interest-areas-input');
        const tagsContainer = document.getElementById('interest-areas-tags');
        const hiddenInput = document.getElementById('interest-areas-hidden');
        let tags = @json(json_decode(old('interest_areas', $group->interest_areas), true) ?? []);

        // Initialize existing tags
        tags.forEach(addTag);

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && this.value) {
                e.preventDefault();
                addTag(this.value);
                this.value = '';
                updateHiddenInput();
            }
        });

        function addTag(text) {
            const tag = document.createElement('span');
            tag.textContent = text;
            tag.classList.add('badge', 'bg-primary', 'me-2', 'mb-2');

            const removeBtn = document.createElement('span');
            removeBtn.textContent = '×';
            removeBtn.classList.add('ms-2', 'cursor-pointer');
            removeBtn.onclick = function() {
                tagsContainer.removeChild(tag);
                tags = tags.filter(t => t !== text);
                updateHiddenInput();
            };

            tag.appendChild(removeBtn);
            tagsContainer.appendChild(tag);
            tags.push(text);
        }

        function updateHiddenInput() {
            hiddenInput.value = JSON.stringify(tags);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isPaidSelect = document.getElementById('is_paid');
        const priceGroup = document.getElementById('price-group');
    
        isPaidSelect.addEventListener('change', function() {
            if (this.value === '1') {
                priceGroup.style.display = 'block';
            } else {
                priceGroup.style.display = 'none';
            }
        });
    });
</script>
@endpush
