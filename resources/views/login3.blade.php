@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
    <!-- Login Form -->
    <!-- NOTE: the use of Blade Conditions, try NOT and use PHP scriptets! -->
    <form action = "dologin3" method = "POST">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <h3>Please Login Into Activity 3 Part 1</h3>
        <table>
            <tr>
                <td>User Name: </td>
                <td><input type = "text" name = "username" maxlength="10" />{{ $errors->first('username') }}</td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type = "password" name = "password" maxlength="10" />{{ $errors->first('password') }}</td>
            </tr>
            <tr>
                <td colspan = "2" align = "center">
                    <input type = "submit" value = "Login" />
                </td>
        </table>
    </form>
    <br/>
    <br/>

    <!-- Display all the Data Validation Rule Errors -->
    <!-- NOTE: the use of Blade Conditions, try NOT and use PHP scriptets! -->
    @if($errors->count() != 0)
    	<h5>List of Errors</h5>
        @foreach($errors->all() as $message)
			{{ $message }} <br/>
        @endforeach         
    @endif
@endsection
