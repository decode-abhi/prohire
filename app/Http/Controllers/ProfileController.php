<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function profileForm(Request $request,$id){
        return view('admin.user.profileForm', compact('id'));
    }

    public function profileUpdate(Request $request,$user_id){
        
        $validator = $request->validate([
          'phone' => 'required|min:5|numeric',
          'address' => 'required',
          'city' => 'required',
          'state' => 'required',
          'country' => 'required',
          'qualification' => 'required',
          'experience' => 'required',
          'skills' => 'required',
          'profile_picture' => 'required'
        ],[
            'phone' => 'phone number is required',
          'address' => 'address is required',
          'city' => 'city is required',
          'state' => 'state is required',
          'country' => 'country is required',
          'qualification' => 'qualification is required',
          'experience' => 'experience is required',
          'skills' => 'skills is required',
          'profile_picture' => 'profile picture is required'
        ]);
       
        if($validator){
            if($request->hasFile('profile_picture')){
                $profilePicture = $request->file('profile_picture');
                $profilePictureName = time().'.'.$profilePicture->extension();
                $profilePicture->storeAs('uploads',$profilePictureName,'public');
            }
            if($request->hasFile('certificates')){
                $certificates = $request->file('certificates');
                $certificatePath = [];
                foreach($certificates as $certificate){
                    $certiFileName = time().'_'.$certificate->getClientOriginalName();
                    $certificate->storeAs('uploads/certificates',$certiFileName,'public');
                    $certificatePath[] = $certiFileName;

                }
            }
            $userProfile = new UserProfile();
            $userProfile->user_id = $user_id;
            $userProfile->profile_picture = $profilePictureName;
            $userProfile->phone = $request->phone;
            $userProfile->address = $request->address;
            $userProfile->city = $request->city;
            $userProfile->state = $request->state;
            $userProfile->country = $request->country;
            $userProfile->qualification = $request->qualification;
            $userProfile->certificates = json_encode($certificatePath); 
            $userProfile->resume = $request->address;
            $userProfile->experience = $request->experience;
            $userProfile->summary = $request->summary;
            $userProfile->github = $request->github;
            $userProfile->linkedin = $request->linkedin;
            $userProfile->skills = $request->skills;
            $userProfile->save();
        }

        return redirect()->route('jobseeker.dashboard')->with('success', 'profile updated successfully');
    }
}
