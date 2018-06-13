<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileFormRequest;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.index');
    }

    public function profileUpdate(UpdateProfileFormRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if($data['password'])
            $data['password'] = bcrypt($data['password']);
        else
            unset($data['password']);

        $data['image'] = $user->image;
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            if($user->image)
                $name = $user->image;
            else
                $name = $user->id.kebab_case($user->name);

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;
            $upload = $request->image->storeAs('users', $nameFile);

            if(!$upload)
                return redirect()->back()->with('error', 'Error uploading profile image!');

            
        }

        if(auth()->user()->update($data))
            return redirect()->route('profile')->with('success', 'Profile updated!');
        return redirect()->back()->with('error', 'Error updating profile!');
        
    }
}
