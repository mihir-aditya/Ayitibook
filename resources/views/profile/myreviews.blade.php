<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Reviews</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .header-left {
      flex: 1;
    }

    /* Search bar row (reused from order history) */
    .search-filter-row {
      flex: 2;
      display: flex;
      justify-content: center;
    }
    .search-filter-row .input-group {
      width: 100%;
      max-width: 400px;
    }

    .divider {
      border-top: 1px dashed #ccc;
      margin: 15px 0 25px;
    }
    .add-btn {
      background: #007bff;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      white-space: nowrap;
    }
    .add-btn:hover { background: #0056b3; }

    .review-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      display: flex;
      gap: 15px;
      align-items: flex-start;
      background: #f9f9f9;
      position: relative;
    }
    .review-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }
    .review-media-count {
      margin: 8px 0;
      display: flex;
      gap: 15px;
      color: #555;
      font-size: 14px;
    }
    
    .review-media-count i {
      margin-right: 5px;
      color: #007bff;
    }
    .review-content { flex: 1; }
    .review-title { font-size: 16px; font-weight: bold; display: flex; justify-content: space-between; align-items: center; }
    .review-heading { font-size: 15px; font-weight: 600; margin-top: 5px; }
    .stars { color: #f39c12; margin: 5px 0; }
    .rating-number { font-size: 14px; margin-left: 6px; color: #555; }
    .review-date { font-size: 13px; color: gray; margin-bottom: 5px; }
    .review-text { margin: 8px 0; }

    /* Media icons */
    .media-icons {
      margin-top: 8px;
    }
    .media-icons button {
      border: none;
      background: #eee;
      padding: 6px 10px;
      margin-right: 8px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      color: #333;
    }
    .media-icons button:hover {
      background: #ddd;
    }

    /* Actions */
    .review-actions {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .review-actions button {
      border: none;
      padding: 6px 12px;
      margin-left: 6px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }
    .edit-btn { background: #28a745; color: white; }
    .edit-btn:hover { background: #218838; }
    .delete-btn { background: #dc3545; color: white; }
    .delete-btn:hover { background: #c82333; }

    .like-dislike {
      margin-top: 10px;
    }
    .like-dislike button {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 15px;
      color: #555;
    }
    .like-dislike button:hover { color: #000; }
    .like-dislike i { margin-right: 5px; }
  </style>
</head>
<body>

@include('includes.header')

<div class="container my-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-3">
      <?php include './includes/sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9"> 
      <div class="container">
        <div class="header">
          <!-- Left -->
          <div class="header-left">
            <h2>My Reviews</h2>
          </div>

          <!-- Center -->
          <div class="search-filter-row">
            <div class="input-group">
              <input id="searchReviews" type="text" class="form-control" placeholder="Search reviews (Title, Rating, Date...)" aria-label="Search">
              <button class="btn btn-primary" id="searchReviewsBtn" type="button" title="Search">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>

          <!-- Right -->
          <button class="add-btn" onclick="alert('Add new review form here!')">+ Add Review</button>
        </div>
        <div class="divider"></div>

        @forelse($reviews as $review)
        <div class="review-card">
          <img src="{{ $review->product->thumbnail ?? ($review->image_urls[0] ?? '../assets/images/wishlist/product-media1.png') }}" alt="Product" class="review-img">
          <div class="review-content">
            <div class="review-title">
              {{ $review->product->name ?? 'Untitled Product' }}
            </div>
            <div class="review-date">Reviewed on: {{ $review->created_at ? $review->created_at->format('d M Y') : 'N/A' }}</div>
            <div class="stars">
              @for ($i = 0; $i < ($review->stars['filled'] ?? round($review->rating)); $i++)
                <i class="fa fa-star"></i>
              @endfor
              @for ($i = 0; $i < ($review->stars['empty'] ?? (5 - round($review->rating))); $i++)
                <i class="fa fa-star-o"></i>
              @endfor
              <span class="rating-number">{{ number_format($review->rating, 1) }} / 5</span>
            </div>
            <div class="review-heading">{{ strlen($review->body) > 60 ? substr($review->body, 0, 57) . '...' : $review->body }}</div>
            <div class="review-text">
              {{ $review->body }}
            </div>

            <!-- Media icons -->
            <div class="media-icons">
              <button><i class="fa fa-image"></i> Photos {{ count($review->image_urls) }}</button>
              <button><i class="fa fa-video"></i> Videos 0</button>
            </div>

            <!-- Like / Dislike -->
            <div class="like-dislike">
              <button><i class="fa fa-thumbs-up"></i> 0</button>
              <button><i class="fa fa-thumbs-down"></i> 0</button>
            </div>

            <!-- Actions top-right -->
            <div class="review-actions">
              <a href="{{ route('reviews.edit', $review) }}" class="edit-btn">Edit</a>
              <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Delete this review?')">Delete</button>
              </form>
            </div>
          </div>
        </div>
        @empty
        <div class="review-card">
          <div class="review-content">
            <p>No reviews yet.</p>
          </div>
        </div>
        @endforelse

      </div>
    </div>
  </div>
</div>

@include('includes.footer')

</body>
</html>

