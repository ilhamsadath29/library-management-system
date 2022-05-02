<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'address'   => 'nullable|string',
            'contact'   => 'nullable|string',
            'profile'   => 'nullable|string',
            'email'     => 'required|email|string|unique:users,email',
            'password'  => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ]);

        if (isset($data['profile'])) {
            $relativePath = $this->saveImage($data['profile']);
            $data['profile'] = $relativePath;
        } 

        $user = User::create([
            'name'     => $data['name'],
            'address'  => $data['address'],
            'contact'  => $data['contact'],
            'profile'  => $data['profile'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'type'     => 2
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    private function saveImage($img)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $img, $type)) {
            $img = substr($img, strpos($img, ',') + 1);

            // Get file extension
            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new \Exception("invalid image type");
            }

            $img = str_replace(' ', '+', $img);
            $img = base64_decode($img);

            if ($img === false) {
                throw new \Exception("base64_decode failed");
            }
        } else {
            throw new \Exception("Did not match data url with image data");
        }

        $dir = 'profiles/';
        $file = Str::random().'.'.$type;

        $absolutePath = public_path($dir);
        $relativePath = $dir.$file;

        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $img);

        return $relativePath;
    }
}
