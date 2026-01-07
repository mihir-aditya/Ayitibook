<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Website Page Title -->
    <title>Contact-Seller | AyitiBook</title>

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
    </style>
</head>

<body>

    <!-- ====================site header ============================================-->
   @include('components.top-header')
  <!-- large size header -->
  @include('components.header')

   
    <!-- end--=========================== -->
    <div class="main-wrapper">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-1">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact-Seller </li>
                </ol>
            </nav>
            <div class="row g-4">
                <div class="contact-seller">
                    <div class="card-body">
                        <form class="contact-seller-form">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" placeholder="John" value="John">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Phone number</label>
                                    <input type="tel" class="form-control" placeholder="Phone number">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <!-- Company Information -->
                                    <div class="mb-3">
                                        <label class="form-label">Company information</label>
                                        <input type="text" class="form-control" placeholder="Company name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Credit card information</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control mb-2"
                                                placeholder="Credit card no.">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="MM / YY">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="CCV">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="location-select">
                                        <label class="form-label">Location</label>
                                        <select class=" form-control form-select">
                                            <option selected>New York, United States</option>
                                            <option>Los Angeles, United States</option>
                                            <option>Chicago, United States</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-check form-check-inline mx-2">

                                        <input class="form-check-input me-2 " type="radio" name="radioOptions"
                                            id="radio1" checked>
                                        <label class="form-check-label" for="radio1">Radio 1</label>
                                    </div>

                                    <div class="form-check form-check-inline mx-2">

                                        <input class="form-check-input me-2" type="radio" name="radioOptions"
                                            id="radio2">
                                        <label class="form-check-label" for="radio2">Radio 2</label>
                                    </div>
                                </div>
                                <!-- Case Description -->
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Describe your case</label>
                                    <textarea class="form-control" rows="4" placeholder="Tell us about your use case..."></textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Site Footer -->
    @include('components.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/custom-swiper.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- mobile js -->
    <script src="assets/js/mobile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
