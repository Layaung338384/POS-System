@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-primary text-center">
                        <h1 class="text-white">Handle Your Customer!</h1>
                    </div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col">
                                    <input type="text" readonly class="form-control" value="{{$userName}}">
                                </div>

                                <div class="col">
                                    <input type="text" readonly class="form-control" value="{{$userPhone}}">
                                </div>

                                <div class="col">
                                    <input type="text" readonly value="{{ $showCusReport->title }}" placeholder="Enter Reoport Title" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <textarea  id="" readonly class="form-control shadow-sm border-0 shadow-sm" cols="30"
                                    rows="8" placeholder="Enter Report Issues" spellcheck="false"> {{ $showCusReport->message }} </textarea>
                                </div>
                            </div>
                            <div class="col">
                                <a class="btn btn-outline-success" href="{{ route("cusReportDelete",$showCusReport->id)}}">Done</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
