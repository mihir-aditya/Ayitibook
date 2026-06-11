<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Book</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;

        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .container.my-4 {
            padding-bottom: 200px;
            /* adjust to your footer height */
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .divider {
            border-top: 1px dashed #ccc;
            margin: 15px 0 25px;
        }

        .add-btn {
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        /* List format */
        .address-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .card {
            position: relative;
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-details {
            flex: 1;
        }

        .card h4 {
            margin: 0 0 5px;
        }


        .card-details p {
            margin: 8px 0;
            line-height: 1.6;
        }

        .card-details i {
            margin-right: 8px;
            color: #666;
            width: 18px;
            /* keeps icons aligned */
            text-align: center;
        }

        .address-book-page .menu {
            position: absolute;
            top: 10px;
            /* distance from top */
            right: 10px;
            /* distance from right */
            cursor: pointer;
            display: inline-block;
        }

        /* menu opens to left inside card */
        .address-book-page .menu-content {
            display: none;
            position: absolute;
            top: 0;
            right: 100%;
            margin-right: 8px;
            /* little spacing from dots */
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            padding: 4px 0;
            z-index: 100;
            min-width: 160px;
            /* increased a bit */
            white-space: nowrap;
            /* prevents text from breaking */
            animation: slideInLeft 0.2s ease;
        }

        /* Add a unique parent class */
        .address-book-page .menu-content button {
            display: block;
            width: 100%;
            padding: 6px 10px;
            font-size: 13px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        .address-book-page .menu-content .danger {
            color: red;
            font-weight: 500;
        }

        .menu-content .danger i {
            margin-right: 6px;
        }

        .address-book-page .menu-content .set-default {
            color: blue;
            font-weight: 500;
            background: none;
            border: none;
            cursor: pointer;
        }

        .set-default i {
            margin-right: 6px;
        }

        /* Add a unique parent class */
        .address-book-page .menu-content button {
            display: block;
            width: 100%;
            padding: 6px 10px;
            font-size: 13px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        .default-tag {
            display: inline-flex;
            align-items: center;
            background: #e0f7e9;
            color: #0a7d3c;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        /* 3D flip animation */
        .flip-container {
            perspective: 1200px;
            min-height: 420px;
        }

        .flipper {
            position: relative;
            width: 100%;
            min-height: 420px;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }

        .flipper.show-back {
            transform: rotateY(180deg);
        }

        .flipper .front,
        .flipper .back {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .flipper .back {
            transform: rotateY(180deg);
        }

        .form-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-box input,
        .form-box textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-box button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .form-box button.cancel {
            background: #dc3545;
            margin-left: 10px;
        }

        /* Cancel button reddish-orange */
        .form-box button.cancel,
        .form-box button[type="button"] {
            background: #ff4500;
            /* reddish-orange */
            color: white;
        }

        .form-box button.cancel:hover,
        .form-box button[type="button"]:hover {
            background: #e03e00;
        }

        /* Save button remains green */
        .form-box button[type="submit"] {
            background: #28a745;
            color: white;
        }

        .form-box button[type="submit"]:hover {
            background: #218838;
        }


        .add-btn {
            background: #007bff;
            /* default blue */
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        /* Go Back button dark yellow */
        .add-btn.green {
            background: #d4a017;
            /* dark yellow */
            color: white;
        }

        .add-btn.green:hover {
            background: #b8860b;
        }

        .add-btn i {
            margin-right: 6px;
        }

        .name-row,
        .phone-row {
            display: flex;
            gap: 10px;
        }

        .name-row input,
        .phone-row input {
            flex: 1;
        }

        .phone-row input:first-child {
            max-width: 80px;
            /* keeps country code smaller */
        }



        /* animation for menu */
        @keyframes slideInLeft {
            from {
                transform: translateX(20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    @include('includes.header')
    <!-- Sidebar -->
    <div class="container my-4">
        <div class="row">

            <!-- Sidebar (col-3) -->
            <div class="col-lg-3">
                <?php include './includes/sidebar.php'; ?>
            </div>
            <!-- Main Content (col-9) -->
            <div class="col-lg-9">
                <div class="container">
                    <div class="header">
                        <h2>Address Book</h2>
                        <button class="add-btn" onclick="flipCard()">+ New Address</button>
                    </div>
                    <div class="divider"></div>

                    <div class="flip-container">
                        <div class="flipper" id="flipper">

                            <!-- Front side -->
                            <div class="front address-book-page">
                                <div class="address-list">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    @if ($addresses->isEmpty())
                                        <div class="card">
                                            <div class="card-details">
                                                <h4>No addresses saved yet.</h4>
                                                <p>Add a new address with the button above.</p>
                                            </div>
                                        </div>
                                    @endif

                                    @foreach ($addresses as $address)
                                        <div class="card">
                                            <div class="card-details">
                                                @if ($address->is_default)
                                                    <div class="default-tag"><i class="fa fa-thumbtack"></i> Default
                                                        Address</div>
                                                @endif
                                                <h4>{{ ucfirst($address->address_type ?? 'Address') }}</h4>
                                                <p>
                                                    <i class="fa fa-user" style="color:#bd2222;"></i>
                                                    {{ $address->first_name }} {{ $address->last_name }}<br>
                                                    <i class="fa fa-map-marker" style="color:#28a745;"></i>
                                                    {{ $address->address }}<br>
                                                    <i class="fa fa-building"></i> {{ $address->city }}
                                                    {{ $address->postal_code }}<br>
                                                    <i class="fa fa-phone" style="color:#17a2b8;"></i>
                                                    {{ $address->mobile_number }}
                                                </p>
                                            </div>
                                            <div class="menu" onclick="toggleMenu(this)">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <div class="menu-content">
                                                    @if (!$address->is_default)
                                                        <form method="POST"
                                                            action="{{ route('account.set-default-address', $address->sl_no) }}"
                                                            style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="set-default"><i
                                                                    class="fa fa-thumbtack"></i> Set as default</button>
                                                        </form>
                                                    @endif
                                                    <button onclick="editAddress({{ $address->sl_no }})"><i
                                                            class="fa fa-pencil"></i> Edit</button>
                                                    <form method="POST"
                                                        action="{{ route('account.delete-address', $address->sl_no) }}"
                                                        style="display:inline; margin-top:4px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="danger"><i
                                                                class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Back side -->
                            <div class="back">
                                <div class="form-box">
                                    <h3>Add New Address</h3>
                                    <form method="POST" action="{{ route('account.add-address') }}">
                                        @csrf
                                        <div class="name-row">
                                            <input type="text" name="first_name" placeholder="First Name" required>
                                            <input type="text" name="last_name" placeholder="Last Name" required>
                                        </div>
                                        <textarea name="address" placeholder="Full Address" required></textarea>

                                        <div class="name-row">
                                            <input type="text" name="city" placeholder="City" required>
                                            <input type="text" name="state" placeholder="State">
                                        </div>

                                        <div class="name-row">
                                            <input type="text" name="country" placeholder="Country" required>
                                            <input type="text" name="postal_code" placeholder="Postal code" required>
                                        </div>

                                        <div class="name-row">
                                            <input type="text" name="phone" placeholder="Phone Number" required>
                                            <input type="text" name="alternate_phone" placeholder="Alternate Phone">
                                        </div>

                                        <label for="addressType"><strong>Address Type</strong></label>
                                        <select id="addressType" name="address_type"
                                            onchange="toggleOtherAddressType(this)" required>
                                            <option value="home">Home</option>
                                            <option value="work">Work</option>
                                            <option value="other">Other</option>
                                        </select>

                                        <input type="text" id="otherAddressType" name="address_type_other"
                                            placeholder="Enter address type" style="display:none; margin-top:10px;">

                                        <label style="margin-top:10px; display:block;"><input type="checkbox"
                                                name="is_default" value="1"> Set as default</label>

                                        <div style="margin-top:12px;">
                                            <button type="button" class="cancel" onclick="flipCard()"><i
                                                    class="fa fa-times"></i> Cancel</button>
                                            <button type="submit" class="btn-save"><i class="fa fa-folder"></i>
                                                Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
    <script>
        function flipCard() {
            const flipper = document.getElementById("flipper");
            const addBtn = document.querySelector(".add-btn");

            flipper.classList.toggle("show-back");

            if (flipper.classList.contains("show-back")) {
                addBtn.innerHTML = '<i class="fa fa-reply"></i> GO BACK';
                addBtn.classList.add("green");
                // match height to back panel
                flipper.style.minHeight = flipper.querySelector(".back").scrollHeight + "px";
            } else {
                addBtn.innerHTML = '<i class="fa fa-plus"></i> New Address';
                addBtn.classList.remove("green");
                // match height to front panel
                flipper.style.minHeight = flipper.querySelector(".front").scrollHeight + "px";
            }
        }



        function toggleMenu(el) {
            let menu = el.querySelector(".menu-content");
            document.querySelectorAll(".menu-content").forEach(m => {
                if (m !== menu) m.style.display = "none";
            });
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(event) {
            if (!event.target.matches('.fa-ellipsis-v')) {
                document.querySelectorAll(".menu-content").forEach(m => m.style.display = "none");
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flipper = document.getElementById("flipper");
            flipper.style.minHeight = flipper.querySelector(".front").scrollHeight + "px";
        });

        function toggleOtherAddressType(select) {
            const otherInput = document.getElementById('otherAddressType');
            if (select.value === "other") {
                otherInput.style.display = "block";
            } else {
                otherInput.style.display = "none";
            }
        }
    </script>


</body>

</html>