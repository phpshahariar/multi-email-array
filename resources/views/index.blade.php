@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @if(Session::get('message'))
                        <h3 class="alert alert-success">{{ Session::get('message') }}</h3>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                        <form action="{{ url('/mail/send') }}" method="post">
                            @csrf
                            <input type="submit" name="btn" class="btn btn-danger" value="Send...">
                        </form>
{{--                        <table class="table table-bordered">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>ID</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $user->id }}</td>--}}
{{--                                    <td>{{ $user->email }}</td>--}}
{{--                                    <td>--}}
{{--                                        <form action="{{ url('sent/email') }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <input type="hidden" name="id" value="{{ $user->id }}">--}}
{{--                                            <input type="submit" name="btn" value="sent mail" class="btn btn-success">--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
                        <div class="card">
                            <div class="card-body">
                                @php($x = 0)
                                <form action="{{ url('/sent/customer/sms') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Enter Email : </label>
                                        <input type="text"  name="email" class="form-control" placeholder="Enter Your mail...">
                                    </div>
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label>Enter Subject : </label>--}}
                                    {{--                                    <input type="text" name="sub" class="form-control" placeholder="Enter Your Subject...">--}}
                                    {{--                                </div>--}}
                                    <div class="form-group">
                                        <label>Enter Message : </label>
                                        <textarea name="message" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn" class="btn btn-danger btn-block">SubmiT</button>
                                    </div>
                                </form>

                            </div>


                            <div class="card-body">
                                @php($x = 0)
                                <form action="{{ url('/sent/customer/sms') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Enter Phone : </label>
                                        <input type="text"  name="email" class="form-control" placeholder="Enter Your Number...">
                                    </div>
                                    {{--                                <div class="form-group">--}}
                                    {{--                                    <label>Enter Subject : </label>--}}
                                    {{--                                    <input type="text" name="sub" class="form-control" placeholder="Enter Your Subject...">--}}
                                    {{--                                </div>--}}
                                    <div class="form-group">
                                        <label>Enter Message : </label>
                                        <textarea name="message" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn" class="btn btn-danger btn-block">SubmiT</button>
                                    </div>
                                </form>

                            </div>




                            @php($x = 0)
                            <form action="{{ url('/save/student') }}" method="post">
                                @csrf
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text"  name="name[]" class="form-control" placeholder="Enter Your Name...">
                                                </td>
                                                <td>
                                                    <input type="text"  name="roll[]" class="form-control" placeholder="Enter Your Roll...">
                                                </td>
                                                <td>
                                                    <a href="#" id="addmore" class="btn btn-sm btn-success">Add More</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <div class="form-group">
                                    <button type="submit" name="btn" class="btn btn-danger btn-block">SubmiT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function () {

            $('#addmore').click(function () {
                addRow();
            });

            function addRow() {
                var add = '<tr id="hide">\n' +
                        '   <td>\n' +
                        '       <input type="text"  name="name[]" class="form-control" placeholder="Enter Your Name...">\n' +
                        '    </td>\n' +
                        '    <td>\n' +
                        '       <input type="text"  name="roll[]" class="form-control" placeholder="Enter Your Roll...">\n' +
                        '    </td>\n' +
                        '    <td>\n' +
                        '       <a href="#" id="remove" class="btn btn-sm btn-danger">Remove</a>\n' +
                        '     </td>\n' +
                    '     </tr>'

                $('tbody').append(add);
            }



        });
    </script>

    <script>
        $(document).click(function () {
            $("#remove").click(function () {
                $(this).parent().parent().remove();

            });
        });
    </script>

@endsection
