<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __invoke()
    {
        // ...
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($request->isMethod('post')) {
            $this->validate($request, $this->validateRules(), [], $this->attributesName() );

            $errors = [];

            if(Hash::check($request->post('password'), $user->password)) {
                $user->fill([
                    'name' => $request->post('name'),
                    'email' => $request->post('email'),
                    'password' => Hash::make($request->post('newPassword')),
                ]);
                $user->save();
            } else {
                $errors['password'][] = 'Неверно введен текущий пароль';
            }
            return redirect()->route('account.profile.update')->withErrors($errors);
        }
        return view('account.profile.update', [
            'user'=>$user,
        ]);
    }

    private function validateRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    private function attributesName()
    {
        return [
            'newPassword' => 'Новый пароль',
        ];
    }
}
