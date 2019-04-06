@extends('layouts.appmaster')
@section('title', 'Login Page')

@section('content')
    <!-- Login Form -->
    <form action = "dologin2" method = "POST">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
        <h3> Please Login Into Activity 2 Part 3</h3>
        <table>
            <tr>
                <td>User Name: </td>
                <td><input type = "text" name = "username" /></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type = "password" name = "password" /></td>
            </tr>
            <tr>
                <td colspan = "2" align = "center">
                    <input type = "submit" value = "Login" />
                </td>
        </table>
    </form>
@endsection
