@extends('layouts.app')


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

          <form action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data" method="post">
          
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="id_number">ID Number:</label>
              <input type="text" class="form-control" name="id_number" value="{{ $student->id_number }}" required autocomplete="id_number" id="id_number" placeholder="Enter ID">
            </div><br>
            
            <div class="form-group">
              <label for="profile_image">Profile:</label>
              @if ($student->profile_image)
              <div>
                <img src="{{ asset('uploads/students/'.$student->profile_image) }}" width="100px" height="100px" alt="Current Profile Image">
              </div>
              @endif
              <input type="file" class="form-control" name="profile_image" required autocomplete="profile_image">
            </div><br>

            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" class="form-control" name="first_name" value="{{ $student->first_name }}" required autocomplete="first_name" id="first_name" placeholder="Enter First Name">
            </div><br>

            <div class="form-group">
              <label for="middlename">Middle Name:</label>
              <input type="text" class="form-control" name="middle_name" value="{{ $student->middle_name }}" required autocomplete="middle_name" id="middle_name" placeholder="Enter Middle Name">
            </div><br>

            <div class="form-group">
              <label for="lastname">Last Name:</label>
              <input type="text" class="form-control" name="last_name" value="{{ $student->last_name }}" required autocomplete="last_name" id="last_name" placeholder="Enter Last Name">
            </div><br>

            <div class="form-group">
              <label for="extension">Name Extension:</label>
              <input type="text" class="form-control" name="name_extension" value="{{ $student->name_extension }}" required autocomplete="name_extension" id="name_extension" placeholder="Enter Name Extension">
            </div><br>

            <div class="form-group">
              <label for="course">Course:</label>
              <select type="text" class="form-select" name="course" value="{{ old('course', $student->course) }}" id="course">
                <option disabled selected value>Select</option>
                <option value="IT" {{ old('course', $student->course) == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HM" {{ old('course', $student->course) == 'HM' ? 'selected' : '' }}>HM</option>
                <option value="ABM" {{ old('course', $student->course) == 'ABM' ? 'selected' : '' }}>ABM</option>
                <option value="STEM" {{ old('course', $student->course) == 'STEM' ? 'selected' : '' }}>STEM</option>
                <option value="GAS" {{ old('course', $student->course) == 'GAS' ? 'selected' : '' }}>GAS</option>
              </select>
            </div><br>

            <div class="form-group">
              <label for="sex">Sex:</label>
              <select type="text" class="form-select" name="sex" id="sex">
                <option disabled selected value>Select</option>
                <option value="Male" {{ old('sex', $student->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('sex', $student->sex) == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div><br>

            <div class="form-group">
              <label for="address">Address:</label>
              <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required autocomplete="address">{{ $student->address }}</textarea>

            </div><br>

            <div class="form-group">
              <label for="contactnumber">Contact Number:</label>
              <input type="text" class="form-control" name="contact_number" value="{{ $student->contact_number }}" required autocomplete="contact_number" id="contact_number" placeholder="Enter Contact Number">
            </div><br>

            <div class="form-group">
              <label for="birthdate">Birthdate:</label>
              <input type="date" class="form-control" name="birthdate" value="{{ $student->birthdate }}" required autocomplete="birthdate" id="birthdate" placeholder="Enter Birth Date">
            </div><br>

            <div class="form-group">
              <label for="is_active">Status:</label>
              <select id="is_active" class="form-select" name="is_active" required>
                <option {{$student->is_active == 1 ? "selected" : ""}} value="1">Active</option>
                <option {{$student->is_active == 0 ? "selected" : ""}} value="0">Inactive</option>
              </select>

            </div>


            <br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="http://joshua.test/students" class="btn btn-secondary">Back</a>
          </form>
          


        </div>
      </div>
    </div>
  </div>
</div>
@endsection