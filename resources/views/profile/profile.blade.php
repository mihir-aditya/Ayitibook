<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: #f8f9fa;
      font-family: "Poppins", sans-serif;
    }

    .profile-card {
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
      margin: 40px auto;
      max-width: 800px;
    }

    .profile-card h3,
    .profile-card h4 {
      font-weight: 600;
      font-size: 18px;
      margin-bottom: 15px;
    }

    .divider {
      border-top: 1px dashed #ccc;
      margin: 15px 0 25px;
    }

    .form-control {
      background: #dbc9c9;
      border: none;
      padding: 10px 12px;
      border-radius: 6px;
      font-size: 14px;
    }

    .form-control:focus {
      box-shadow: none;
      border: 1px solid #ccc;
    }

    .btn-outline-secondary {
      border: 1px solid #000;
      color: #000;
      background: #fff;
      border-radius: 6px;
      padding: 8px 18px;
    }

    .btn-outline-secondary:hover {
      background: #000;
      color: #fff;
    }

    .btn-danger {
      background: #d9534f;
      border: none;
      border-radius: 6px;
      padding: 8px 18px;
    }

    /* Eye icon positioning */
    .password-wrapper {
      position: relative;
    }

    .password-wrapper .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #777;
    }

    .password-wrapper .toggle-password:hover {
      color: #000;
    }

    /* Password toggle header */
    .password-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .password-header button {
      border: 2px solid #d9534f;
      background: #fff;
      color: #d9534f;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .password-header button:hover {
      background: #d9534f;
      color: #fff;
    }
  </style>
  
<style>
/* Profile Picture Styles */
.profile-pic-wrapper {
  position: relative;
  display: inline-block;
}

.profile-pic-wrapper img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border: 3px solid #d9534f;
}

.profile-pic-wrapper .edit-icon {
  position: absolute;
  bottom: 0;
  right: 0;
  background: #fff;
  border-radius: 50%;
  padding: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.profile-pic-wrapper .edit-icon:hover {
  background: #d9534f;
  color: #fff;
}

#deletePic {
  display: block;
  margin: 0 auto;
}

</style>
</head>
<php>
<body>

@include('includes.header')
 <!-- Sidebar -->
   <div class="container my-4">
  <div class="row">
    
    <!-- Sidebar (col-3) -->
    <div class="col-lg-3">
      <?php include './includes/sidebar.php'; ?>
    </div>
      <!-- Profile Edit Section -->
    <div class="col-lg-9">
      <div class="profile-card">
        <h3>Edit Your Profile</h3>
        <div class="divider"></div>

  <!-- Profile Picture Section -->
  <div class="profile-pic-wrapper text-center mb-4 position-relative">
    <img src="profilepic/default.jpg" id="profilePic" class="rounded-circle" alt="Profile Picture">
    <label for="profileInput" class="edit-icon">
      <i class="fa fa-pencil"></i>
    </label>
    <input type="file" id="profileInput" accept="image/*" style="display:none">
    <button type="button" id="deletePic" class="btn btn-danger btn-sm mt-2 d-none">Delete</button>
  </div>
  
    <form>
      <div class="row g-3 mb-4">
        <div class="col-md-4 position-relative">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control" value="Md" /> 
          <span class="edit-icon" style="position:absolute; right:10px; top:38px; cursor:pointer;">&#9998;</span>
        </div>
        <div class="col-md-4 position-relative">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control" value="Rimel" />
          <span class="edit-icon" style="position:absolute; right:10px; top:38px; cursor:pointer;">&#9998;</span>
        </div>
         <div class="col-md-3 position-relative">
           <label class="form-label">Gender</label>
           <select class="form-select" >
             <option value="">Select Gender</option>
             <option value="male">Male</option>
             <option value="female">Female</option>
             <option value="others">Others</option>
             <option value="not_say">Prefer not to say</option>
           </select>
         </div>
        <div class="col-md-6 position-relative">
          <label class="form-label">Phone No.</label>
            <div class="d-flex">
              <select class="form-select me-2" style="max-width:75px;">
                <option value="+91">+91</option>
                <option value="+1">+1</option>
                <option value="+44">+44</option>
                <option value="+61">+61</option>
              </select>
              <input type="text" class="form-control" placeholder="Enter your Number" />
            </div>
          <span class="edit-icon" style="position:absolute; right:10px; top:38px; cursor:pointer;">&#9998;</span>
        </div>
        <div class="col-md-5 position-relative">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" value="alex143@gmail.com"  />
          <span class="edit-icon" style="position:absolute; right:10px; top:38px; cursor:pointer;">&#9998;</span>
        </div>
        <div class="col-md-12 position-relative">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" value="Kingston, 5236, United State" />
          <span class="edit-icon" style="position:absolute; right:10px; top:38px; cursor:pointer;">&#9998;</span>
        </div>
      </div>
          
      <div class="divider"></div>

      <!-- Password Section with Dropdown -->
      <div class="password-header">
        <h4>Change your Password </h4>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#passwordSection" aria-expanded="false"
          aria-controls="passwordSection">
           <i class="fa fa-pencil"></i> Change  <i class="fa fa-chevron-right ms-2 arrow-icon"></i>
        </button>
      </div>
      <br>

      <div id="passwordSection" class="collapse">
        <div class="row g-3">
          <div class="col-12 password-wrapper">
            <input type="password" class="form-control" id="currentPassword" placeholder="Current Password" />
            <i class="fa fa-eye-slash toggle-password" onclick="togglePassword('currentPassword', this)"></i>
          </div>
          <div class="col-12 password-wrapper">
            <input type="password" class="form-control" id="newPassword" placeholder="New Password" />
            <i class="fa fa-eye-slash toggle-password" onclick="togglePassword('newPassword', this)"></i>
          </div>
          <div class="col-12 password-wrapper">
            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm New Password" />
            <i class="fa fa-eye-slash toggle-password" onclick="togglePassword('confirmPassword', this)"></i>
          </div>
        </div>
      </div>

      <div class="mt-4 d-flex justify-content-end">
        <button type="button" class="btn btn-danger me-2">Cancel</button>
        <button type="submit" class="btn btn-outline-secondary me-2">Save Changes</button>
      </div>
    </form>
  </div>t
    </div>
</div>
</div>



@include('includes.footer')


  <script>
    function togglePassword(fieldId, icon) {
      const field = document.getElementById(fieldId);
      if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      } else {
        field.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      }
    }

    // Change chevron direction
    const passwordSection = document.getElementById("passwordSection");
    const toggleBtn = document.querySelector(".password-header button");
    const toggleIcon = toggleBtn.querySelector(".arrow-icon");

    passwordSection.addEventListener("show.bs.collapse", () => {
      toggleIcon.classList.remove("fa-chevron-right");
      toggleIcon.classList.add("fa-chevron-down");
    });

    passwordSection.addEventListener("hide.bs.collapse", () => {
      toggleIcon.classList.remove("fa-chevron-down");
      toggleIcon.classList.add("fa-chevron-right");
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <script>
// Profile Picture Change
const profileInput = document.getElementById('profileInput');
const profilePic = document.getElementById('profilePic');
const deleteBtn = document.getElementById('deletePic');

profileInput.addEventListener('change', function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      profilePic.src = e.target.result;
      deleteBtn.classList.remove('d-none');
    };
    reader.readAsDataURL(file);
  }
});

// Delete Profile Picture
deleteBtn.addEventListener('click', function () {
  profilePic.src = 'profilepic/default.jpg';
  profileInput.value = '';
  this.classList.add('d-none');
});
</script>


</body>

</html>
