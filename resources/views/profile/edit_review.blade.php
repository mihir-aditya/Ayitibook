<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
@include('includes.header')
<div class="container my-4">
  <div class="row">
    <div class="col-lg-3">
      <?php include './includes/sidebar.php'; ?>
    </div>
    <div class="col-lg-9">
      <h3>Edit Review</h3>

      <form action="{{ route('reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
          <label class="form-label">Rating</label>
          <select class="form-control" name="rating" required>
            @for ($i = 1; $i <= 5; $i++)
              <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} star</option>
            @endfor
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Current Images</label>
          @if($review->image_urls)
            <div class="d-flex flex-wrap gap-2">
              @foreach($review->image_urls as $index => $imageUrl)
                <div class="position-relative">
                  <img src="{{ $imageUrl }}" alt="Review Image" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ddd;">
                  <div class="form-check position-absolute top-0 end-0">
                    <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $index }}" id="remove_{{ $index }}">
                    <label class="form-check-label bg-white px-1" for="remove_{{ $index }}">
                      Remove
                    </label>
                  </div>
                </div>
              @endforeach
            </div>
            <small class="text-muted">Check the boxes to remove selected images.</small>
          @else
            <p>No images attached.</p>
          @endif
        </div>

        <div class="mb-3">
          <label class="form-label">Add New Images (Optional)</label>
          <input type="file" class="form-control" name="images[]" multiple accept="image/*">
          <small class="text-muted">You can select multiple images. Max 5 images, 2MB each.</small>
        </div>

        <div class="mb-3">
          <label class="form-label">Review Comment</label>
          <textarea class="form-control" name="body" rows="4" required>{{ old('body', $review->body) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Review</button>
        <a href="{{ route('profile.page', ['page' => 'myreviews']) }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
@include('includes.footer')
</body>
</html>