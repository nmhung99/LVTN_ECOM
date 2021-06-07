<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => [
            'verify',
            'resendmail',
            'resend'
        ]]);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        if (Auth::check()) {
            //role = 'admin';
            return redirect('/home');
        }
        $user = User::find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified())
            event(new Verified($user));

        // return redirect($this->redirectPath())->with('verified', true);
         return view('auth.login')->with('success', 'Chúc mừng bạn đã xác minh thành công. Xin mời đăng nhập');
    }

    public function resendmail()
    {
        return view('auth.resend');
    }

    protected function resend(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        // $user->verifyToken = Str::random(40);
        // $user->save();

        // $this->sendEmail($user);

        // return $user;
        if ($user == NULL) {
            return response()->json([
                    'status' => 'not_found',
                    'message' => 'Không Tìm Thấy Email'
                ], 400); 
        } else {
            if ($user->email_verified_at != NULL) {
                return response()->json([
                    'status' => 'verified',
                    'message' => 'Email Này Đã Được Xác Minh'
                ], 400); 
            } else {
                // event(new Verified($user));
                $user->notify(new VerifyEmail);
                // $request->user()->where('email', $request->input('email'))->sendEmailVerificationNotification();
                // Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
                return response()->json([
                    'status' => true,
                    'message' => 'Đã Gửi Lại Email Xác Minh'
                ], 200); 
            }
        }
        

        
    }

    // public function verify(Request $request)
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('home');
    //     }
    //     if (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
    //         throw new AuthorizationException;
    //     }

    //     if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
    //         throw new AuthorizationException;
    //     }

    //     if ($request->user()->hasVerifiedEmail()) {
    //         return $request->wantsJson()
    //                     ? new JsonResponse([], 204)
    //                     : redirect($this->redirectPath());
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     if ($response = $this->verified($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //                 ? new JsonResponse([], 204)
    //                 : redirect($this->redirectPath())->with('verified', true);
    // }
}
