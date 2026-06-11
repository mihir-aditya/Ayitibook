<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>My Account |AyitiBook</title>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="author" content="Author Name">
    <meta name="robots" content="index, follow">

    <!-- Viewport Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon Tags -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">

    <!-- CSS Stylesheet Link -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- common css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/header.css">


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <style>
        /* Optional: hide content initially */
        .accordion-body {
            display: none;
            padding: 10px;
            background: #fff;
        }

        .accordion-body.show {
            display: block;
        }


        /* header code */
        body {
            overflow-x: hidden;
            /* Prevent page from scrolling horizontally */
        }

        /* Added By JK ....Start  */
        #megamenu {
            position: sticky;
            top: 70px;
            /* adjust to match your header height */
            z-index: 100;
            /* background: white; */
            display: none;
            /* default is hidden */
            /* box-shadow: 0 2px 5px rgba(0,0,0,0.1); */
        }

        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu.open-left {
            left: auto;
            right: 220px;
            /* opens to the left */
        }

        .inner-sub-menu {
            left: 220px;
            /* default */
        }

        .inner-sub-menu.open-left {
            left: auto;
            right: 220px;
        }

        /* Added By JK ....End  */

        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu {
            right: auto;
            left: 100%;
            min-width: 220px;
        }

        .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
            display: block;
        }

        @media screen and (max-width: 1200px) {

            /* If menu goes beyond screen width, show to the left instead */
            .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
                left: auto;
                right: 100%;
            }
        }

        .category-list {
            background-color: #f7f4f424;
            padding: 0px 10px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 4px 0px;
        }


        .category-list .parent-menu-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .category-list .parent-menu-list a {
            color: #000;
        }

        .category-list .parent-menu {
            padding: 11px 13px;
            position: relative;
        }

        /* Submenu styling */
        .category-list .inner-menu {
            background:
                #fff;
            position: absolute;
            top: 100%;
            left: 0;
            padding:
                0;
            box-shadow: rgba(96, 93, 93, 0.21) 0px 2px 9px;
            border-radius:
                4px;
            opacity: 0;
            visibility: hidden;
            transition:
                all 0.3s ease-in-out;
            z-index: 10;
            width: 220px;
        }

        /* Submenu item */
        .category-list .inner-menu .inner-sub-menu-list {
            padding: 12px 17px;
            white-space: nowrap;
            position: relative;
            color: #131212;
            font-weight: 400;
            font-size: 14px;
        }

        .inner-sub-menu-list {
            position: relative !important;
        }

        .inner-sub-menu-list::after {
            content: "\f105";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: inherit;
            font-size: 13px;
            font-family: "Font Awesome 5 free";
            font-weight: 900;
        }

        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu {
            position: absolute;
            left: 220px;
            width: 220px;
            top: -1px;
            background:
                #fbfbfb;
            opacity: 0;
            visibility: hidden;
            transition:
                all 0.3s ease-in-out;
            z-index: 10;
            box-shadow: rgba(0, 0, 0, 0.1) -4px 4px 8px;
            border:
                1px solid #d3d3d34f;
            border-radius:
                4px;
        }

        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li {
            padding: 12px 16px;
        }

        .parent-menu-list .parent-menu:hover .main-link {
            transition: all 0.5s ease-in-out;
            color: var(--bs-primary);

        }

        /* Hover effect */
        .category-list .parent-menu:hover>.inner-menu {
            opacity: 1;
            visibility: visible;
        }

        .category-list .inner-menu .inner-sub-menu-list:hover {
            background: #e8b3ba;
            font-weight: 500;
        }

        .category-list .inner-menu .inner-sub-menu-list:hover>.inner-sub-menu {
            opacity: 1;
            visibility: visible;
        }

        .category-list .inner-menu .inner-sub-menu-list .inner-sub-menu li:hover {
            background: #f2c0ce;
        }

        .not:hover {
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <!-- large size header -->
    @include('includes.header')


    <div class="page-wrapper">
        <main class="main-wrapper">
            <div class="container">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </nav>
                <div class="row">
                    <!-- Sidebar Links -->
                    <div class="col-lg-3 mb-4">
                        <ul class="nav nav-pills flex-column gap-2 aside-menu">
                            <li class="nav-item">
                                <a class="nav-link active" id="myProfile-tab" data-bs-toggle="pill" href="#myProfile"
                                    role="tab"><i class='bx bx-user-circle'></i><span>
                                        My Profile
                                    </span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="addressBook-tab" data-bs-toggle="pill" href="#addressBook"
                                    role="tab"> <i class='bx bx-file'></i> Address Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="paymentOptions-tab" data-bs-toggle="pill" href="#paymentOptions"
                                    role="tab"> <i class='bx bx-wallet'></i> My Payment
                                    Options</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="myOrders-tab" data-bs-toggle="pill" href="#myOrders"
                                    role="tab"> <i class='bx bx-gift'></i> My Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="myReturns-tab" data-bs-toggle="pill" href="#myReturns"
                                    role="tab"> <i class='bx bx-credit-card-front'></i> My Returns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="myWishlist-tab" data-bs-toggle="pill" href="#myWishlist"
                                    role="tab"><i class='bx bx-heart-circle'></i> My Wishlist</a>
                            </li>
                            @auth
                                @if(optional(auth()->user())->affiliate)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('affiliate.dashboard', auth()->user()->affiliate->affiliate_code) }}">
                                            <i class='bx bx-line-chart'></i> Affiliate Dashboard
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="col-lg-9">
                        <div class="tab-content">
                            <!-- My Profile Tab -->
                            <div class="tab-pane fade show active" id="myProfile" role="tabpanel">
                                <h3 class="main-title mb-4">Edit Your Profile</h3>
                                <form id="profileForm">
                                    @csrf
                                    <div class="row g-3 mb-5">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName"
                                                value="{{ $user->first_name ? $user->first_name : '' }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName"
                                                value="{{ $user->last_name ? $user->last_name : '' }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="number" class="form-label">Phone No.</label>
                                            <input type="number" class="form-control not" id="phone"
                                                placeholder="Enter your Number"
                                                value="{{ $user->phone ? $user->phone : '' }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ $user->email ? $user->email : '' }}" disabled />
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                value="Kingston, 5236, United State" />
                                        </div> --}}
                                    </div>



                                    <h4 class="main-title mb-4">Password Changes</h4>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="password" class="form-control"
                                                placeholder="Current Password" id="currentPassword" />
                                        </div>
                                        <div class="col-12">
                                            <input type="password" class="form-control" placeholder="New Password"
                                                id="newPassword" />
                                        </div>
                                        <div class="col-12">
                                            <input type="password" class="form-control"
                                                placeholder="Confirm New Password" id="confirmPassword" />
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-secondary me-2">Save Changes
                                        </button>
                                        <button type="button" class="btn btn-secondary me-2">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Address Book Tab -->
                            <div class="tab-pane fade" id="addressBook" role="tabpanel">
                                <h3 class="main-title mb-4">Address Book</h3>
                                {{-- show saved address with default --}}
                              <div class="mt-4 mb-4">
    <h4 class="main-title mb-4">Saved Addresses</h4>

    @forelse ($addresses as $address)
        <div class="mb-4">
            <div class="card shadow-sm border-0 {{ $address->is_default ? 'border border-success' : '' }}">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    
                    <!-- Left: Address Info -->
                    <div class="mb-3 mb-md-0">
                        <h3 class="card-title mb-2">
                           <img src="https://cdn-icons-png.flaticon.com/128/2550/2550264.png" alt="" width="20" height="20"> {{ $address->first_name }} {{ $address->last_name }}
                        </h3>
                        <p class="card-text mb-1">
                            {{ $address->address }}, {{ $address->city }} - {{ $address->postal_code }}
                        </p>
                        <p class="card-text mb-1">
                           Phone: {{ $address->mobile_number }} {{ $address->alternate_mobile_number ? ' | Alt: ' . $address->alternate_mobile_number : '' }}
                        </p>
                        
                        {{-- <p class="card-text">
                            <span class="badge bg-secondary text-capitalize">
                                {{ $address->address_type }}
                            </span>
                            @if ($address->is_default)
                                <span class="badge bg-success">Default</span>
                            @endif
                        </p> --}}
                    </div>

                    <!-- Right: Actions -->
                    <div class="text-end">
                        @if (!$address->is_default)
                            <button class="btn btn-sm btn-success mb-2 w-100 w-md-auto set-default-btn"
                                data-id="{{ $address->id }}">
                                Set as Default
                            </button>
                        @elseif ($address->is_default)
                            <span class="badge bg-success mb-2 d-inline-block w-100 w-md-auto">Default Address</span>
                        @endif

                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary edit-address-btn" 
                                data-id="{{ $address->id }}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger delete-address-btn"
                                data-id="{{ $address->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No saved addresses found.</p>
    @endforelse
</div>


                                {{-- <button type="button" class="btn btn-primary">Add New Address</button> --}}




                                <form id="addressForm" class="mt-4">
                                    @csrf
                                    <h4 class="main-title mb-4">Add New Address</h4>
                                    <div class="row g-3 mb-5">
                                        <div class="col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="addressFirstName"
                                                placeholder="Enter your First Name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="addressLastName"
                                                placeholder="Enter your Last Name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addressPhone" class="form-label">Phone No.</label>
                                            <input type="number" class="form-control" id="addressPhone"
                                                placeholder="Enter your Number" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addressAlternatePhone" class="form-label">Alter Phone
                                                No.</label>
                                            <input type="number" class="form-control" id="addressAlternatePhone"
                                                placeholder="Enter your Alternate Phone No." />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Enter your Address" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addressCity" class="form-label">City</label>
                                            <input type="text" class="form-control" id="addressCity"
                                                placeholder="Enter your City" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="addressPostalCode" class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="addressPostalCode"
                                                placeholder="Enter your Postal Code" />
                                        </div>
                                        {{-- now create a radio button for address type  --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Address Type</label>
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="addressType"
                                                        id="homeAddress" value="home" checked>

                                                    <label class="form-check-label" for="homeAddress">
                                                        Home
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="addressType"
                                                        id="workAddress" value="work">
                                                    <label class="form-check-label" for="workAddress">
                                                        Work
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="addressType"
                                                        id="otherAddress" value="other">
                                                    <label class="form-check-label" for="otherAddress">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- is_default --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Set as Default Address</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isDefaultAddress"
                                                    name="is_default" value="1">
                                                <label class="form-check-label" for="isDefaultAddress">
                                                    Yes, set this as my default address
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-secondary me-2">Save Changes
                                        </button>
                                        <button type="button" class="btn btn-secondary me-2">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Payment Options Tab -->
                            <div class="tab-pane fade" id="paymentOptions" role="tabpanel">
                                <h3 class="main-title mb-4">Payment Options</h3>
                                <p>Manage your payment methods here.</p>
                            </div>

                            <!-- Orders Tab -->
                            <div class="tab-pane fade" id="myOrders" role="tabpanel">
                                <h3 class="main-title mb-4">My Orders</h3>
                                <p>View your order history here.</p>
                            </div>

                            <!-- Returns Tab -->
                            <div class="tab-pane fade" id="myReturns" role="tabpanel">
                                <h3 class="main-title mb-4">My Returns</h3>
                                <p>Manage your returns here.</p>
                            </div>

                            <!-- Wishlist Tab -->
                            <div class="tab-pane fade" id="myWishlist" role="tabpanel">
                                <h3 class="main-title mb-4">My Wishlist</h3>
                                <!-- Swiper -->
                                <div class="swiper wishlist-swiper mb-4">
                                    <div class="swiper-wrapper">
                                        
                                        @foreach ($wishlist as $item)
                                            <div class="swiper-slide">
                                            <div class="wishlist-item mb-2">
                                                <div class="media-box ">
                                                    <div class="product-img">
                                                        <a href="/product/{{ $item->product->slug }}">
                                                            <img src="{{ $item->product->thumbnail }}" alt="media">
                                                        </a>

                                                        <div class="hover-btn">
                                                            <a href="/cart" class="btn add-cart"> Add To
                                                                Cart</a>
                                                        </div>
                                                    </div>
                                                    <span class="badge style1 badge-primary">
                                                        -35%
                                                    </span>
                                                    <div class="product-icon-div">
                                                        <ul class="ps-0">
                                                            <li class="share-icon meta-icon">
                                                                <a href="" class=""><i
                                                                        class='bx bx-share bx-flip-horizontal'></i></a>
                                                            </li>
                                                            <li class="delete-icon meta-icon">
                                                                <a href="" class=""><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="content-box">
                                                    <h6 class="title">
                                                        <a href="/product/{{ $item->product->slug }}">{{ $item->product->name }}</a>
                                                    </h6>
                                                    <div class="meta-div">
                                                        <span class="text1 text-danger">${{ $item->product->price }}</span>
                                                        <p class="text1 text-gray "> <strike>${{ $item->product->original_price }}</strike></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>


        <!-- Site Footer -->
        @include('includes.footer')

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- mobile js -->
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts JS -->
    <script>
        $("#leftside-navigation .sub-menu > a").click(function(e) {
            $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
                e.stopPropagation()
        })
    </script>

    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#profileForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form values
                var firstName = $('#firstName').val().trim();
                var lastName = $('#lastName').val().trim();
                var email = $('#email').val().trim();
                var currentPassword = $('#currentPassword').val().trim();
                var newPassword = $('#newPassword').val().trim();
                var confirmPassword = $('#confirmPassword').val().trim();

                // Client-side validation
                if (firstName === '' || lastName === '') {
                    Toastify({
                        text: "First Name and Last Name cannot be empty.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    }).showToast();
                    return;
                }

                if (currentPassword !== '') {
                    if (newPassword === '' || confirmPassword === '') {
                        Toastify({
                            text: "Please enter a New Password & confirm it to change your password.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                        return;
                    }

                    if (newPassword.length < 8) {
                        Toastify({
                            text: "New Password must be at least 8 characters long.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                        return;
                    }

                    if (confirmPassword !== '' && (newPassword !== confirmPassword)) {
                        Toastify({
                            text: "New Password and Confirm New Password do not match.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                        return;
                    }
                } else {
                    if (newPassword !== '' || confirmPassword !== '') {
                        Toastify({
                            text: "Enter your Current Password to change your password.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                        return;
                    }
                }


                // Prepare data for AJAX request
                var formData = {
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    current_password: currentPassword ?? '',
                    new_password: newPassword ?? '',
                    _token: $('input[name="_token"]').val() // CSRF token
                };
                // Send AJAX request to update profile
                $.ajax({
                    url: '{{ route('updateProfile') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success === true) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                            // Clear password fields
                            $('#currentPassword').val('');
                            $('#newPassword').val('');
                            $('#confirmPassword').val('');
                        } else if (response.success === false) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {

                        const message = JSON.parse(xhr.responseText);

                        Toastify({
                            text: message.message ? message.message :
                                "An error occurred. Please try again.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                    }
                });
            });

            $('#addressForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form values
                var firstName = $('#addressFirstName').val().trim();
                var lastName = $('#addressLastName').val().trim();
                var phone = $('#addressPhone').val().trim();
                var alternatePhone = $('#addressAlternatePhone').val().trim();
                var address = $('#address').val().trim();
                var city = $('#addressCity').val().trim();
                var postalCode = $('#addressPostalCode').val().trim();
                var addressType = $('input[name="addressType"]:checked').val();
                var isDefault = $('#isDefaultAddress').is(':checked') ? 1 : 0;

                // Client-side validation
                if (firstName === '') {
                    Toastify({
                        text: "First Name cannot be empty.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    }).showToast();
                    return;
                }

                if (phone === '') {
                    Toastify({
                        text: "Phone Number cannot be empty.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    }).showToast();
                    return;
                }

                if (address === '' || city === '' || postalCode === '') {
                    Toastify({
                        text: "Address, City, and Postal Code cannot be empty.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    }).showToast();
                    return;
                }

                // Prepare data for AJAX request
                var formData = {
                    first_name: firstName,
                    last_name: lastName,
                    phone: phone,
                    alternate_phone: alternatePhone,
                    address: address,
                    city: city,
                    postal_code: postalCode,
                    address_type: addressType,
                    is_default: isDefault,
                    _token: $('input[name="_token"]').val() // CSRF token
                };
                // Send AJAX request to update profile
                $.ajax({
                    url: '{{ route('addAddress') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success === true) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                            // Clear form fields
                            $('#addressForm')[0].reset();

                            setTimeout(function() {
                                location.reload();
                            }, 1500); // Reload after 1.5 seconds to show the updated address list
                        } else if (response.success === false) {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {

                        const message = JSON.parse(xhr.responseText);

                        Toastify({
                            text: message.message ? message.message :
                                "An error occurred. Please try again.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        }).showToast();
                    }
                });
            });

        });
    </script>

</body>

</html>
