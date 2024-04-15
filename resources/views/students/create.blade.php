@extends('layouts.app')

<style>
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('NEW STUDENT') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form action="{{route("students.store")}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
              <label for="id_number">ID Number:</label>
              <input type="text" class="form-control" name="id_number" id="id_number" placeholder="Enter ID" required>
            </div><br>

            <div class="form-group">
              <label for="profile_image">Profile:</label>
              <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 100px; max-height: 100px; display: none;" required>
              <input type="file" class="form-control" id="profile_image" name="profile_image" onchange="previewImage()">
            </div><br>

            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" required>
            </div><br>

            <div class="form-group">
              <label for="middlename">Middle Name:</label>
              <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Enter Middle Name" required>
            </div><br>

            <div class="form-group">
              <label for="lastname">Last Name:</label>
              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required>
            </div><br>

            <div class="form-group">
              <label for="extension">Name Extension:</label>
              <input type="text" class="form-control" name="name_extension" id="name_extension" placeholder="Enter Name Extension" required>
            </div><br>

            <div class="form-group">
              <label for="course">Course:</label>
              <select type="text" class="form-select" name="course" id="course" required>
                <option disabled selected value>Select</option>
                <option value="IT">IT</option>
                <option value="HM">HM</option>
                <option value="ABM">ABM</option>
                <option value="STEM">STEM</option>
                <option value="GAS">GAS</option>
              </select>
            </div><br>

            <div class="form-group">
              <label for="sex">Sex:</label>
              <select type="text" class="form-select" name="sex" id="sex" required>
                <option disabled selected value>Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div><br>

            <div class="form-group">
              <label for="address">Address:</label>
              <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required></textarea>
            </div><br>

            <div class="form-group">
              <label for="contactnumber">Contact Number:</label>
              <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number" required>
            </div><br>

            <div class="form-group">
              <label for="birthdate">Birthdate:</label>
              <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Enter Birth Date" required>
            </div><br>

            <div class="form-group">
              <label for="status">Status:</label>
              <select type="text" class="form-select" name="is_active" id="is_active" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>

            </div>


            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="http://joshua.test/students" class="btn btn-secondary">Back</a>
          </form>

          <script>
            function previewImage() {
              const fileInput = document.getElementById('profile_image');
              const imagePreview = document.getElementById('imagePreview');

              if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                  imagePreview.src = e.target.result;
                  imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(fileInput.files[0]);
              }
            }
          </script>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection