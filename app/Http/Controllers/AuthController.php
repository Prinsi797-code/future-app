<?php

namespace App\Http\Controllers;

use App\Jobs\CleanupInvestorUser;
use App\Mail\SendUserLoginInfoMail;
use App\Models\DummyEntrepreneur;
use App\Models\DummyInvestor;
use App\Models\Entrepreneur;
use App\Models\Investor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class AuthController extends Controller
{
    public function showMobileForm(Request $request)
    {
        \Log::info('showMobileForm called', [
            'auth_check' => Auth::check(),
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role ?? 'No role',
            'request_path' => $request->path()
        ]);
        // if (Auth::check()) {
        //     $user = Auth::user();

        // Check if user has entrepreneur entry in DummyEntrepreneur table
        // $dummyEntrepreneur = DummyEntrepreneur::where('user_id', $user->id)->first();

        // Check if user has investor entry in DummyInvestor table
        // $dummyInvestor = DummyInvestor::where('user_id', $user->id)->first();

        // if ($dummyEntrepreneur && $user->role === 'entrepreneur') {
        // User is logged in and has entrepreneur entry, redirect to entrepreneur form
        // return redirect()->route('entrepreneur.form', $user->id);
        // } elseif ($user->role === 'investor' && $dummyInvestor) {
        // Check if investor form is complete (e.g., all required steps are completed)
        // $completedSteps = $dummyInvestor->completed_steps ? json_decode($dummyInvestor->completed_steps, true) : [];
        // $requiredSteps = [2, 3, 4]; // Adjust based on required steps
        // if (count(array_intersect($requiredSteps, $completedSteps)) === count($requiredSteps)) {
        // Investor form is complete, redirect to homepage
        // return redirect()->route('home'); // Assumes 'home' route points to '/'
        // } else {
        // Investor form is not complete, redirect to investor form
        // return redirect()->route('investor.form', $user->id);
        // }
        // } elseif ($user->role === 'investor') {
        // Investor role but no DummyInvestor record, redirect to investor form
        // return redirect()->route('investor.form', $user->id);
        // } elseif ($user->role === null) {
        // If user doesn't have role, redirect to choose role
        // return redirect()->route('mobile.form');
        // }
        // }

        $query = Entrepreneur::where('approved', 1);

        // Filter: Already Funded
        if ($request->filter === 'alreadyfunded') {
            $query->where('interested', 1);
        }

        // Search Inputs: name, country, market_capital
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('country', 'like', '%' . $searchTerm . '%')
                    ->orWhere('market_capital', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy('created_at', 'desc');

        $approvedEntrepreneurs = $query->take(4)->get();

        $countries = [
            ['code' => '+91', 'name' => 'IN'],
            ['code' => '+1', 'name' => 'USA'],
            ['code' => '+44', 'name' => 'UK'],
            ['code' => '+971', 'name' => 'UAE'],
            ['code' => '+65', 'name' => 'SG'],
            ['code' => '+61', 'name' => 'AU'],     // Australia
            ['code' => '+81', 'name' => 'JP'],     // Japan
            ['code' => '+86', 'name' => 'CN'],     // China
            ['code' => '+49', 'name' => 'DE'],     // Germany
            ['code' => '+33', 'name' => 'FR'],     // France
            ['code' => '+39', 'name' => 'IT'],     // Italy
            ['code' => '+7', 'name' => 'RU'],     // Russia
            ['code' => '+34', 'name' => 'ES'],     // Spain
            ['code' => '+82', 'name' => 'KR'],     // South Korea
            ['code' => '+66', 'name' => 'TH'],     // Thailand
            ['code' => '+92', 'name' => 'PK'],     // Pakistan
            ['code' => '+880', 'name' => 'BD'],     // Bangladesh
            ['code' => '+94', 'name' => 'LK'],     // Sri Lanka
            ['code' => '+60', 'name' => 'MY'],     // Malaysia
            ['code' => '+62', 'name' => 'ID'],     // Indonesia
            ['code' => '+63', 'name' => 'PH'],     // Philippines
            ['code' => '+20', 'name' => 'EG'],     // Egypt
            ['code' => '+234', 'name' => 'NG'],     // Nigeria
            ['code' => '+27', 'name' => 'ZA'],     // South Africa
            ['code' => '+974', 'name' => 'QA'],     // Qatar
            // Add more countries as needed
        ];

        return view('mobile', compact('countries', 'approvedEntrepreneurs'));
    }

    // public function sendOtp(Request $request)
    // {
    //     // $validLengths = [
    //     //     '+91' => 10,  // India
    //     //     '+1' => 10,   // USA
    //     //     '+44' => 10,  // UK
    //     //     '+971' => 9,  // UAE
    //     //     '+65' => 8,   // Singapore
    //     //     '+61' => 9,   // Australia
    //     //     '+81' => 10,  // Japan
    //     //     '+86' => 11,  // China
    //     //     '+49' => 11,  // Germany
    //     //     '+33' => 9,   // France
    //     //     '+39' => 10,  // Italy
    //     //     '+7' => 10,   // Russia
    //     //     '+34' => 9,   // Spain
    //     //     '+82' => 10,  // South Korea
    //     //     '+66' => 9,   // Thailand
    //     //     '+92' => 10,  // Pakistan
    //     //     '+880' => 10, // Bangladesh
    //     //     '+94' => 9,   // Sri Lanka
    //     //     '+60' => 9,   // Malaysia
    //     //     '+62' => 10,  // Indonesia
    //     //     '+63' => 10,  // Philippines
    //     //     '+20' => 10,  // Egypt
    //     //     '+234' => 10, // Nigeria
    //     //     '+27' => 9,   // South Africa
    //     //     '+974' => 8,  // Qatar
    //     // ];

    //     // $fullPhoneNumber = $request->country_code . $request->phone_number;

    //     // Check if full phone number already exists
    //     // $existingUser = User::where('phone_number', $fullPhoneNumber)->first();


    //     // If user already exists, redirect back with error
    //     // if ($existingUser) {
    //     //     return back()->withErrors(['phone_number' => 'This phone number is already registered.'])->withInput();
    //     // }

    //     // Check if email already exists


    //     // Validate inputs
    //     $request->validate([
    //         // 'country_code' => 'required',
    //         'email' => 'required|email',

    //         'role' => 'required|in:entrepreneur,investor',
    //     ]);

    //     $emailExists = User::where('email', $request->email)->exists();

    //     if ($emailExists) {
    //         return back()->withErrors(['email' => 'This email is already registered.'])->withInput();
    //     }

    //     // Generate OTP
    //     $otp = rand(100000, 999999);

    //     // Create new user
    //     $user = User::create([
    //         // 'country_code' => $request->country_code,
    //         'email' => $request->email,
    //         // 'phone_number' => $fullPhoneNumber,
    //         'otp' => $otp,
    //         'otp_expires_at' => Carbon::now()->addMinutes(10),
    //         'role' => $request->role,
    //         'is_verified' => false,
    //     ]);

    //     Mail::to($request->email)->send(new SendOtpMail($otp));

    //     session()->flash('otp_sent', "OTP sent to successfully");

    //     return redirect()->route('otp.form', ['email' => $request->email,]);


    // }
    // public function sendOtp(Request $request)
    // {
    //     // Validate inputs
    //     $request->validate([
    //         'email' => 'required|email',
    //         'role' => 'required|in:entrepreneur,investor',
    //     ]);

    //     // Check if email exists in users table
    //     $user = User::where('email', $request->email)->first();

    //     try {
    //         if ($user) {
    //             // Check if the user has completed their profile based on role
    //             $profileExists = false;
    //             if ($user->role === 'investor') {
    //                 $profileExists = Investor::where('user_id', $user->id)->exists();
    //             } elseif ($user->role === 'entrepreneur') {
    //                 $profileExists = Entrepreneur::where('user_id', $user->id)->exists();
    //             }

    //             if ($profileExists) {
    //                 // If profile exists, show error
    //                 return back()->withErrors(['email' => 'This email is already registered and profile is complete.'])->withInput();
    //             } else {
    //                 // If profile is incomplete, update existing user with new OTP and role
    //                 $otp = rand(100000, 999999);
    //                 $user->update([
    //                     'otp' => $otp,
    //                     'otp_expires_at' => Carbon::now()->addMinutes(10),
    //                     'role' => $request->role,
    //                     'is_verified' => false,
    //                 ]);
    //             }
    //         } else {
    //             // Create new user if email doesn't exist
    //             $otp = rand(100000, 999999);
    //             $user = User::create([
    //                 'email' => $request->email,
    //                 'otp' => $otp,
    //                 'otp_expires_at' => Carbon::now()->addMinutes(10),
    //                 'role' => $request->role,
    //                 'is_verified' => false,
    //             ]);
    //         }

    //         // Cleanup logic for verified users with incomplete profiles
    //         $users = User::where('is_verified', true)
    //             ->where('otp_expires_at', '<=', Carbon::now())
    //             ->get();

    //         foreach ($users as $existingUser) {
    //             $shouldDelete = false;
    //             $reason = '';

    //             if ($existingUser->role === 'investor') {
    //                 $investorExists = Investor::where('user_id', $existingUser->id)->exists();
    //                 if (!$investorExists) {
    //                     $shouldDelete = true;
    //                     $reason = 'Investor profile not completed within time limit';
    //                 }
    //             } elseif ($existingUser->role === 'entrepreneur') {
    //                 $entrepreneurExists = Entrepreneur::where('user_id', $existingUser->id)->exists();
    //                 if (!$entrepreneurExists) {
    //                     $shouldDelete = true;
    //                     $reason = 'Entrepreneur profile not completed within time limit';
    //                 }
    //             }

    //             if ($shouldDelete) {
    //                 Log::info('Deleting user due to incomplete profile', [
    //                     'user_id' => $existingUser->id,
    //                     'email' => $existingUser->email,
    //                     'reason' => $reason,
    //                 ]);
    //                 $existingUser->delete();
    //             }
    //         }

    //         // Send OTP email
    //         Mail::to($request->email)->send(new SendOtpMail($otp));

    //         session()->flash('otp_sent', "OTP sent successfully");

    //         return redirect()->route('otp.form', ['email' => $request->email]);

    //     } catch (\Exception $e) {
    //         Log::error('Error processing user or sending OTP', [
    //             'email' => $request->email,
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //         ]);

    //         return back()->withErrors(['email' => 'Something went wrong. Please try again.'])->withInput();
    //     }
    // }
    public function sendOtp(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:entrepreneur,investor',
        ]);

        try {
            // Check if email exists in users table
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // Check if the user is trying to register with the same role
                if ($user->role === $request->role) {
                    // Check if the user has completed their profile based on role
                    $profileExists = false;
                    if ($user->role === 'investor') {
                        $profileExists = Investor::where('user_id', $user->id)->exists();
                    } elseif ($user->role === 'entrepreneur') {
                        $profileExists = Entrepreneur::where('user_id', $user->id)->exists();
                    }

                    if ($profileExists) {
                        // If profile exists for the same role, show error
                        return back()->withErrors(['email' => 'This email is already registered with this role and profile is complete.'])->withInput();
                    } else {
                        // If profile is incomplete, update OTP
                        $otp = rand(100000, 999999);
                        $user->update([
                            'otp' => $otp,
                            'otp_expires_at' => Carbon::now()->addMinutes(10),
                            'is_verified' => false,
                        ]);
                    }
                } else {
                    // If the role is different, check if role1 is already set
                    if ($user->role1 && $user->role1 !== $request->role) {
                        return back()->withErrors(['email' => 'This email is already registered with two roles.'])->withInput();
                    }

                    // Update role1 with the new role and generate OTP
                    $otp = rand(100000, 999999);
                    $user->update([
                        'role1' => $request->role,
                        'otp' => $otp,
                        'otp_expires_at' => Carbon::now()->addMinutes(10),
                        'is_verified' => false,
                    ]);
                }
            } else {
                // Create new user if email doesn't exist
                $otp = rand(100000, 999999);
                $user = User::create([
                    'email' => $request->email,
                    'otp' => $otp,
                    'otp_expires_at' => Carbon::now()->addMinutes(10),
                    'role' => $request->role,
                    'is_verified' => false,
                ]);
            }

            // Cleanup logic for verified users with incomplete profiles
            $users = User::where('is_verified', true)
                ->where('otp_expires_at', '<=', Carbon::now())
                ->get();

            foreach ($users as $existingUser) {
                $shouldDelete = false;
                $reason = '';

                if ($existingUser->role === 'investor') {
                    $investorExists = Investor::where('user_id', $existingUser->id)->exists();
                    if (!$investorExists) {
                        $shouldDelete = true;
                        $reason = 'Investor profile not completed within time limit';
                    }
                } elseif ($existingUser->role === 'entrepreneur') {
                    $entrepreneurExists = Entrepreneur::where('user_id', $existingUser->id)->exists();
                    if (!$entrepreneurExists) {
                        $shouldDelete = true;
                        $reason = 'Entrepreneur profile not completed within time limit';
                    }
                }

                // Check for role1 profile completion if role1 exists
                if ($existingUser->role1 === 'investor') {
                    $investorExists = Investor::where('user_id', $existingUser->id)->exists();
                    if (!$investorExists) {
                        $shouldDelete = true;
                        $reason = 'Investor profile (role1) not completed within time limit';
                    }
                } elseif ($existingUser->role1 === 'entrepreneur') {
                    $entrepreneurExists = Entrepreneur::where('user_id', $existingUser->id)->exists();
                    if (!$entrepreneurExists) {
                        $shouldDelete = true;
                        $reason = 'Entrepreneur profile (role1) not completed within time limit';
                    }
                }

                if ($shouldDelete) {
                    Log::info('Deleting user due to incomplete profile', [
                        'user_id' => $existingUser->id,
                        'email' => $existingUser->email,
                        'reason' => $reason,
                    ]);
                    $existingUser->delete();
                }
            }

            // Send OTP email
            Mail::to($request->email)->send(new SendOtpMail($otp));

            session()->flash('otp_sent', "OTP sent successfully");

            return redirect()->route('otp.form', ['email' => $request->email]);

        } catch (\Exception $e) {
            Log::error('Error processing user or sending OTP', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors(['email' => 'Something went wrong. Please try again.'])->withInput();
        }
    }

    public function showOtpForm($email)
    {
        return view('otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid or Expired OTP']);
        }

        Auth::login($user);

        $user->update([
            'is_verified' => true,
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect()->route('password.form', ['email' => $user->email]);
        // $redirectRole = $user->role1 ?? $user->role;
        // Redirect based on role
        // if ($redirectRole === 'entrepreneur') {
        //   return redirect()->route('entrepreneur.form', ['user_id' => $user->id]);
        //} else {
        //  return redirect()->route('investor.form', ['user_id' => $user->id]);
        // }
    }


    public function showPasswordForm($email)
    {
        return view('Auth.password', ['email' => $email]);
    }

    public function createPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['password' => 'Invalid password or password confirmation']);
        }

        $plainPassword = $request->password;

        $user->update([
            'password' => Hash::make($request->password),
            'is_verified' => true,
        ]);

        $redirectRole = $user->role1 ?? $user->role;

        Mail::to($user->email)->send(new SendUserLoginInfoMail($user->name, $user->email, $plainPassword));

        Log::info('Email sent successfully to:', ['email' => $user->email]);
        // Redirect based on role
        if ($redirectRole === 'entrepreneur') {
            return redirect()->route('entrepreneur.form', ['user_id' => $user->id]);
        } else {
            return redirect()->route('investor.form', ['user_id' => $user->id]);
        }
    }

    public function showPassword($request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['password' => 'Invalid password or password confirmation']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'is_verified' => true,
        ]);

        return redirect()->route('password.form', ['email' => $user->email]);
    }


    public function chooseRole($user_id)
    {
        $user = User::find($user_id);

        if (!$user || !$user->is_verified) {
            return redirect()->route('mobile.form');
        }

        return view('choose-role', compact('user'));
    }

    public function setRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:entrepreneur,investor'
        ]);

        $user = User::find($request->user_id);
        $user->update(['role' => $request->role]);

        if ($request->role === 'entrepreneur') {
            return redirect()->route('entrepreneur.form', ['user_id' => $user->id]);
        } else {
            return redirect()->route('investor.form', ['user_id' => $user->id]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('mobile.form');
    }

    public function getUser(Request $request)
    {
        Log::info('getUser called', [
            'query_params' => $request->all(),
            'user_id' => Auth::id()
        ]);

        // Build query
        $query = User::select('id', 'name', 'email', 'is_verified', 'role');

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('role')) {
            if ($request->input('role') === 'null') {
                $query->whereNull('role');
            } else {
                $query->where('role', $request->input('role'));
            }
        }

        // Fetch users with pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        // Append query parameters to pagination links
        $users->appends($request->only(['name', 'email', 'role']));

        // Log the retrieved users
        Log::info('Users retrieved', ['count' => $users->count()]);

        // Pass filter values to retain them in the form
        $filters = [
            'name' => $request->input('name', ''),
            'email' => $request->input('email', ''),
            'role' => $request->input('role', '')
        ];

        return view('Auth.user', compact('users', 'filters'));
    }
}