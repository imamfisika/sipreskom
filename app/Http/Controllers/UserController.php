<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    public function viewRegister() {
        return view('auth.register');
    }

    public function viewLogin() {
        return view('auth.login');
    }


    public function register(Request $request) {
    }

    public function login(Request $request) {
       
    }

    public function getById(Request $request) {

    }

    public function getAll(Request $request) {
        // Logic to get all users
    }

    public function delete(Request $request) {
        // Logic to delete a user
    }
}
