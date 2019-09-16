<?php
namespace App\Controllers\POSTA;

use App\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Admin;
use App\Utilities\G_PasswordUtility;
use App\Utilities\G_JWT;
//check if email exists
		//$mailExists = Admin::where("email","email")->first();

class API_AuthController extends BaseController{
	
	//login process
	public function login($req,$res,$args){
		//return json_encode($req->getParsedBody()['id'],true);

		$email = $req->getParsedBody()['email'];
		$password = $req->getParsedBody()['password'];

		$Validator = new G_PasswordUtility(); 
		$G_JWT = new G_JWT();
		$user = Admin::where('email','=',$email)
						  ->first();
		//verify password
		$isPasswordOK = $Validator->verify($password,$user->password);
		if(sizeof($user) == 1 && $isPasswordOK == true){
			$token = $G_JWT->get_token_for_user($user,$user->id);
			return $res->withJSON([ "token" => $token,"admin"=>$user],200);
		}else{
			$data = [
				"msg_data" => "Invalid Credentials!",
				"msg_status" => "FAILED"
			];
			return $res->withJSON($data,301);
		};
	}
	//

}