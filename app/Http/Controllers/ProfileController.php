<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use Exception;

class ProfileController extends Controller
{
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    /**
     * Return the authenticated user as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        try {
            $user = $this->profileService->profile();
            return response()->json(['data' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileRequest $request)
    {
        try {
            $user = $this->profileService->update($request, auth()->user());
            return response()->json(['data' => $user, 'message' => 'User Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function complexFunction() {
        if (true) {
            if (true) {
                for ($i = 0; $i < 10; $i++) {
                    while (true) {
                        switch ($i) {
                            case 1:
                                echo "Nested nightmare!";
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }
    }

    public function duplicate1() {
        echo "Duplicate me!";
    }
    
    public function duplicate2() {
        echo "Duplicate me!";
    }

    public function myTesting(){
        if (true) {
            if (true) {
                if (true) {
                    echo "This is bad";
                }
            }
        }
    }

    public function badPractice() {
        if (1 == 1) {
            echo 'Do something dangerous!';
        }
    }
    
}
