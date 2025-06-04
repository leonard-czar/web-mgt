@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $project->project_name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $project->description }}</p>
                    <p><strong>Task:</strong> {{ $project->task }}</p>
                    <p><strong>Assigned to:</strong> {{ $project->employee->name ?? 'Not assigned' }}</p>
                    @if($project->employee && $project->employee->department)
                    <p><strong>Department:</strong> {{ $project->employee->department->name }}</p>
                    @endif
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Comments ({{ $project->comments->count() }})</h5>
                </div>
                <div class="card-body">
                    {{-- Add Comment Form (any authenticated user can comment) --}}
                    @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group mb-1">
                            <label for="content">Add a comment:</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                name="content" rows="3" placeholder="Write your comment here..."
                                required>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                    <hr>
                    @else
                    <div class="alert alert-info">
                        Please <a href="{{ route('login') }}">log in</a> to add comments.
                    </div>
                    @endauth

                    {{-- Display Comments --}}
                    @forelse($project->comments as $comment)
                    <div class="comment-item border-bottom pb-3 mb-3" id="comment-{{ $comment->id }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="comment-content flex-grow-1">
                                <div class="comment-header mb-2">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->user->email }}</small>
                                    <small class="text-muted ms-2">
                                        {{ $comment->created_at->diffForHumans() }}
                                        @if($comment->created_at != $comment->updated_at)
                                        (edited)
                                        @endif
                                    </small>
                                </div>
                                <div class="comment-text" id="comment-text-{{ $comment->id }}">
                                    {{ $comment->content }}
                                </div>

                                {{-- Edit Form (hidden by default, only for comment authors) --}}
                                @auth
                                @if($comment->user_id === auth()->id())
                                <form action="{{ route('comments.update', $comment) }}" method="POST"
                                    class="edit-form mt-2" id="edit-form-{{ $comment->id }}" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="content" rows="3"
                                            required>{{ $comment->content }}</textarea>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                        <button type="button" class="btn btn-sm btn-secondary cancel-edit"
                                            data-comment-id="{{ $comment->id }}">Cancel</button>
                                    </div>
                                </form>
                                @endif
                                @endauth
                            </div>

                            {{-- Action Buttons (only for comment authors) --}}
                            @auth
                            @if($comment->user_id === auth()->id())
                            <div class="comment-actions ms-3">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item edit-comment"
                                                data-comment-id="{{ $comment->id }}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit Project</a>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for comment editing --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Edit comment functionality
    document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const commentText = document.getElementById(`comment-text-${commentId}`);
            const editForm = document.getElementById(`edit-form-${commentId}`);
            
            commentText.style.display = 'none';
            editForm.style.display = 'block';
            this.closest('.dropdown-menu').style.display = 'none';
        });
    });

    // Cancel edit functionality
    document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const commentText = document.getElementById(`comment-text-${commentId}`);
            const editForm = document.getElementById(`edit-form-${commentId}`);
            
            commentText.style.display = 'block';
            editForm.style.display = 'none';
        });
    });
});
</script>
@endpush
@endsection