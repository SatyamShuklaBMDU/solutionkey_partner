<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone_number' => 'required|string|min:10|unique:vendors,phone_number',
                'password' => 'required|string|min:6',
                'email' => 'required|email|unique:vendors,email',
            ]);
            if ($validator->fails()) {
                $response = ['status' => false];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $randomDigits = mt_rand(10000, 99999);
            $vendorid = 'VEND' . $randomDigits;
            $vendor = new Admin();
            $vendor->fill($request->all());
            $vendor->password = Hash::make($request->input('password'));
            $vendor->vendor_id = $vendorid;
            $vendor->account_status = '0';
            $vendor->save();
            return response()->json(['message' => 'Vendor registered successfully', 'data' => $vendor], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to register vendor', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request)
    {
        try {
            $login = Auth::user();
            $vendor = Admin::findOrFail($login->id);
            $validatedData = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'highest_qualification' => 'nullable|string|max:255',
                'gender' => 'nullable|in:male,female,other',
                'profession' => 'nullable|string|max:255',
                'area_of_interest' => 'nullable|string|max:255',
                'phone_number' => 'string|max:20',
                'email' => 'nullable|string|email|max:255|unique:vendors,email,' . $vendor->id,
                'experience' => 'nullable|string|max:255',
                'current_job' => 'nullable|string|max:255',
                'charge_per_minute_for_audio_call' => 'nullable|numeric',
                'charge_per_minute_for_video_call' => 'nullable|numeric',
                'charge_per_minute_for_chat' => 'nullable|numeric',
                'adhar_number' => 'nullable|string|max:12|min:12',
                'pancard' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:50',
                'state' => 'nullable|string|max:50',
                'address' => 'nullable|string|max:100',
                'about' => 'nullable|string',
                'status' => 'nullable|string|max:255',
                'profile_picture' => 'nullable|image|max:2048',
                'cover_picture' => 'nullable|image|max:2048',
            ]);
            if ($validatedData->fails()) {
                $response = ['status' => false];
                foreach ($validatedData->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture');
                $profilePictureName = 'profile_' . time() . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->move(public_path('profile_pictures'), $profilePictureName);
                $vendor->profile_picture = 'profile_pictures/' . $profilePictureName;
            }

            if ($request->hasFile('cover_picture')) {
                $coverPicture = $request->file('cover_picture');
                $coverPictureName = 'cover_' . time() . '.' . $coverPicture->getClientOriginalExtension();
                $coverPicture->move(public_path('cover_pictures'), $coverPictureName);
                $vendor->cover_picture = 'cover_pictures/' . $coverPictureName;
            }
            $vendor->update($request->only([
                'name',
                'highest_qualification',
                'gender',
                'profession',
                'area_of_interest',
                'phone_number',
                'email',
                'experience',
                'current_job',
                'charge_per_minute_for_audio_call',
                'charge_per_minute_for_video_call',
                'charge_per_minute_for_chat',
                'adhar_number',
                'pancard',
                'city',
                'state',
                'address',
                'about',
                'status',
            ]));
            $vendor->save();
            $baseUrl = "https://bmdublog.com/SolutionkeyPartner/public/";
            $responseData = $vendor->toArray();
            if ($vendor->profile_picture) {
                $responseData['profile_picture_url'] = $baseUrl . $vendor->profile_picture;
            }
            if ($vendor->cover_picture) {
                $responseData['cover_picture_url'] = $baseUrl . $vendor->cover_picture;
            }    
            return response()->json(['message' => 'Vendor details updated successfully', 'data' => $responseData], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Vendor not found'], Response::HTTP_NOT_FOUND);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update vendor details', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function vendorDetails(Request $request)
    {
        $login = Auth::user();
        if (!$login) {
            return response()->json(['message' => 'Not Authenticated Vendor'], Response::HTTP_UNAUTHORIZED);
        }
        $login->status = $login->status ? 'Online' : 'Offline';
        return response()->json(['Vendor' => $login, 'message' => 'Vendors All Details'], Response::HTTP_OK);
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|numeric',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                $response = ['status' => false];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $user = \App\Models\Admin::where('phone_number', $request->phone_number)->first();
            if (!$user) {
                return response()->json(['phone_number' => 'The provided credentials are incorrect.'], Response::HTTP_BAD_REQUEST);
            }
            if ($user->account_status == 0) {
                return response()->json(['message' => 'User account is pending.'], Response::HTTP_BAD_REQUEST);
            } elseif ($user->account_status == 2) {
                return response()->json(['message' => 'User account is suspended.'], Response::HTTP_BAD_REQUEST);
            } elseif ($user->account_status == 1) {
                if (Auth::guard('admins')->attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {
                    $vendor = Auth::guard('admins')->user();
                    $token = $vendor->createToken('VendorAppToken')->plainTextToken;
                    return response()->json(['message' => 'Login Successful.', 'token' => $token, 'id' => $vendor->id], Response::HTTP_OK);
                } else {
                    return response()->json(['phone_number' => 'The provided credentials are incorrect.'], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json(['message' => 'Invalid account status.'], Response::HTTP_BAD_REQUEST);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:4',
        ]);
        if ($validator->fails()) {
            $response = ['status' => false];
            foreach ($validator->errors()->toArray() as $field => $messages) {
                $response[$field] = $messages[0];
            }
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        // dd(Auth::user()->password);
        $pass = Auth::user()->password;
        if (Auth::user()) {
            if (Hash::check($request->password, $pass)) {
                $request->user()->tokens()->delete();
                return response()->json(['message' => 'Logout successful','status' => 'success',], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Invalid password','status' => false], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'User not authenticated',
                'status' => 'error',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:4',
                'confirm_password' => 'required|string|same:new_password',
            ]);
            if ($validator->fails()) {
                $response = ['status' => false];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $vendor = Auth::user();
            if (!Hash::check($request->current_password, $vendor->password)) {
                return response()->json(['message' => 'The provided current password is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $vendor->password = Hash::make($request->new_password);
            $vendor->save();
            return response()->json(['message' => 'Password changed successfully'], Response::HTTP_OK);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to change password', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
