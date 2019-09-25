<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return response()->json(['users' => $users],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validatorCreate($request->all());

        if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 404);
        }

        $user = $this->add($request->all());

        if($user) {
          return response()->json(['user' => $user], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['user' => $user], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $this->validatorUpdate($request->all(), $user);

        if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 404);
        }

        if($request->has('name')) {
          $user->name = $request->name;
        }

        if($request->has('surname')) {
          $user->surname = $request->surname;
        }

        if($request->has('dni')) {
          $user->dni = $request->dni;
        }

        if($request->has('email')) {
          $user->email = $request->email;
        }

        if($request->has('phone')) {
          $user->phone = $request->phone;
        }

        $user->save();

        if($user) {
          return response()->json(['user' => $user], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        if($user) {
          return response()->json(['status' => 'User deleted'], 201);
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCreate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2','max:255'],
            'surname' => ['required', 'string', 'min:2', 'max:255'],
            'dni' => ['required', 'integer', 'unique:users,dni','min:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => 'required|numeric|unique:users,phone|digits:10',
        ]);
    }


        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validatorUpdate(array $data, User $user)
        {
            return Validator::make($data, [
                'name' => ['required', 'string', 'min:2','max:255'],
                'surname' => ['required', 'string', 'min:2', 'max:255'],
                'dni' => ['required', 'integer', 'unique:users,dni,' . $user->id,'min:4'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'phone' => ['required', 'numeric', 'unique:users,phone,'. $user->id, 'digits:10'],
            ]);
        }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function add(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'dni' => $data['dni'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
}
