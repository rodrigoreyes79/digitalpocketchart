<?php namespace App\Security;

use DB;
use App\User;
use App\Doctor;
use App\Staff;
use App\Patient;
use App\Role;
use Log;
use Hash;
use Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Builder;
use App\Company;
use App\Initiative;
use App\InitiativeVersion;
use App\Goal;
use App\Sponsor;
use App\FunctionalArea;

class Auth {

    private static $userInfo = null;
	private static $permissions;

    public static function init($user){
        self::$userInfo = $user;
		if(empty(self::$userInfo)){
			self::$userInfo = self::getUserInfo();
        }

        if(self::$userInfo != null){
			self::$permissions = self::$userInfo["role"]['permissions'];
		} else {
			Log::debug('User was not found. Denied all permissions');
			self::$permissions = [];
		}

		Log::debug('Permissions: ' . print_r(self::$permissions, true));
    }

    public static function getUserInfo(){
        $token = Request::header('Authorization');
        Log::debug('Authorization Header: ' . $token);

        $authCookie = Request::cookie('auth');
        Log::debug('Authorization Cookie: ' . $authCookie);

        $authInfo = null;

        if (!empty($token)) {
            $userInfo = Auth::getUserAndPassword($token);

            if ($userInfo["username"] != null) {
                $username = $userInfo["username"];
                $password = $userInfo["password"];

                Log::debug('Authenticating user: '.$username.$password);

                $authInfo = User::where('email', '=', $username)->first();
                if(!empty($authInfo)){
                    if(!Hash::check($password, $authInfo->password)){
                        Log::debug('Incorrect password');
                        $authInfo = null;
                    }
                } else {
                    Log::debug('User ' . $username . ' was not found in DB');
                }
            } else {
                Log::debug('No User provided');
            	$authInfo = null;
            }
        } else if(!empty($authCookie)) {
            Log::debug('Using Auth Cookie: ' . $authCookie);
            try {
                $token = (new Parser())->parse($authCookie);
                $signer = new Sha256();
                if($token->verify($signer, config('app.key'))){
                    $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
                    $data->setIssuer('http://finurabms.com');
                    $data->setAudience('http://finurabms.com');
                    if($token->validate($data)){
                        $userId = $token->getClaim('uid');
                        $authInfo = User::where('id', $userId)->first();
                    } else {
                        Log::debug('Invalid JWT token');
                    }
                } else {
                    Log::debug('Invalid JWT signature');
                }
            } catch(\Exception $e){
                Log::debug('Invalid JWT token');
            }
        } else {
            Log::debug('No valid authorization method found');
        }

        // Adding role information
        if(!empty($authInfo)){
            Log::debug('RoleId: ' . $authInfo->role_id);
            $role = Role::where('id', $authInfo->role_id)->first();

            if(!empty($role)){
                $role->permissions = json_decode($role->permissions);
            }

            // Making space for the rest of the information
            $authInfo = [
                'user' => $authInfo,
                'role' => $role
            ];
        }

        return $authInfo;
	}

    private static function getUserAndPassword($token){
        $username = null;
        $password = null;
        $token = explode(" ", $token);
        if(sizeof($token) > 1){
            $parts = explode(":", base64_decode($token[1]));
            if(sizeof($parts) > 0){
                $username = $parts[0];
            }
            if(sizeof($parts) > 1){
                $password = $parts[1];
            }
        }

        return [
            "username" => $username,
            "password" => $password
        ];
    }

    public static function getToken($userId){
        $signer = new Sha256();

        $token = (new Builder())->setIssuer('http://finurabms.com') // Configures the issuer (iss claim)
            ->setAudience('http://finurabms.com') // Configures the audience (aud claim)
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            //->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('uid', $userId) // Configures a new claim, called "uid"
            ->sign($signer, config('app.key')) // creates a signature using "testing" as key
            ->getToken(); // Retrieves the generated token

        return '' . $token;
    }

    public static function authorize($permission){
		$ret = false;
        foreach(self::$permissions as $p){
            if("+$permission" == $p){
                $ret = true;
                break;
            } else if("-$permission" == $p){
                break;
            }
        }

		Log::debug("$permission Authorization: " . $ret);
		return $ret;
	}
}
