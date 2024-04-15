@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
@section('content')


<style>
    th {
        text-align: center;
        border: 2px solid black;
        vertical-align: middle;
    }

    td {
        text-align: center;
        border: 2px solid black;
    }

    td:hover {
        background-color: lightgrey;
        font-weight: bold;
    }
    .table-responsive{
        border-radius: 4px;
        background-color: black;
    }
    .active {
        font-weight: bold;
        font-family: Arial;
        letter-spacing: 2px;

    }

    .inactive {
        font-weight: bold;
        font-family: Arial;
        letter-spacing: 2px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('') }}
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('List of Students')}}</h4>
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus fs-5"></i>
                            <span style="font-weight: bolder;">Add Student</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row d-flex justify-content-right">
                        <div class="col-md-4 mb-3">
                            <form action="{{route('students.index')}}" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                                    <button icon type="submit" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>

                                </div>
                            </form>
                        </div>
                    </div>





                    <!-- Students Table -->
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Profile</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Middle Name</th>
                                    <th>Extension</th>
                                    <th>Course</th>
                                    <th>Sex</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>Birthdate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td style="font-size: 2em;">{{ $student->id_number }}</td>
                                    <td>
                                        <img style="border: 2px solid black;" src="{{ asset('uploads/students/'.$student->profile_image) }}" width="70px" height="80px" alt="Image">
                                    </td>
                                    
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->middle_name }}</td>
                                    <td>{{ $student->name_extension }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>{{ $student->sex }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->contact_number }}</td>
                                    <td>{{ $student->birthdate }}</td>
                                    <td class="{{ $student->is_active == 1 ? 'active' : 'inactive' }}">
                                        <span style="color: {{ $student->is_active == 1 ? 'green' : 'gray' }}">
                                            {{ $student->is_active == 1 ? 'ACTIVE' : 'INACTIVE' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{route("students.edit", $student->id)}}" class="btn btn-primary mb-1"><i class="bi bi-pencil fs-5"></i></a>
                                        <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deleteStudent('{{ $student->id }}')" class="btn btn-danger">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                

                                <script>
                                    function deleteStudent(studentId) {
                                        Swal.fire({
                                            title: 'Are you sure to delete this Student?',
                                            text: 'This action cannot be undone',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Yes, delete it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('delete-form-' + studentId).submit();
                                            }
                                        });
                                    }
                                </script>

                                </td>


                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection