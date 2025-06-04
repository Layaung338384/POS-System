@extends('user.layout.master')

@section('content')
    <div class="container" style="margin:150px">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-primary text-center">
                        <h1 class="text-white">Report to Admin</h1>
                        <p class="text-danger">You can report any complain and any issues....</p>
                    </div>
                    <form action="{{ route('contact') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col">
                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}" id="">
                                    <input type="text" readonly class="form-control" value="{{ Auth::user()->name}}">
                                </div>
                                <div class="col">
                                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter Reoport Title" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <textarea name="message" id="" class="form-control shadow-sm border-0 shadow-sm" cols="30"
                                    rows="8" placeholder="Enter Report Issues" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <input type="submit" value="Report" class="btn btn-primary w-100"  name="" id="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
