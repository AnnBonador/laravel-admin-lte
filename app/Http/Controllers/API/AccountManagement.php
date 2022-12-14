<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Validator;
use App\Models\User;
use Auth;
use Hash;
class AccountManagement extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            //'middlename' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
       // $success = $request->specialization_id;
   
        $input = $request->except('c_password');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->fname.' '.$user->lname;
        $success['message'] = 'User Register Succesfully';
   
        return response()->json($success);
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user_details'] =  $user;
   
            return response()->json($success);
        } 
        else{ 
            $error['message'] = 'Invalid Username or Password';
            return response()->json($error);
        } 
    }

    public function UserProfile(){
        $user = Auth::user();
        return response()->json($user);
    }

    public function updateProfile(Request $request){

        $userid = $request->id;
        
        if($request->filled('password')){
            $get_user = User::where('id','=',$userid)->first();
            if(!Hash::check($request->o_password, $get_user->password)) {
                return response()->json(['success' => false, 'message' => 'The old password does not match our records.' ]);
            }
            $data = $request->except(['o_password', 'id']);
            $data['password'] = Hash::make($data['password']);
            $query = User::where('id', '=', $userid)->update($data);
            return response()->json(['success' => true, 'message' => 'Profile Updated Succesfully' ]);
            
        }
        $data = $request->except('id');
        $query = User::where('id', '=', $userid)->update($data);
        
        // $query->fname = $request->firstname;
        // $query->lname = $request->lastname;
        // $query->address = $request->address;
        // $query->dob = $request->dob;
        // $query->contact = $request->contact;
        // $query->email = $request->email;
        // $query->password = $request->password;
        // $query->save();

        return response()->json(['success' => true, 'message' => 'Profile Updated Succesfully' ]);


    }

    public function reset_password(Request $request){
        $credentials = ['email' => $request->email];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json(['status' => trans($response)]);
            case Password::INVALID_USER:
                return response()->json(['status' => trans($response)]);
        }
    }
}