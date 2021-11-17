<?php namespace App\Controllers;
//use App\Models\UsersModel;

use App\Libraries\Hash;

class Admin extends BaseController
{

    public function __construct(){
        helper(['url','form']);
    }
	public function index()
	{
        //echo "welcome olusegun";
        return view ('admin/login');
	}

	public function login(){
       // return view ('pages/home');
             echo view ('admin/login');
            // echo view('templates/footer');
             
    }
    public function register(){

              echo view('admin/register');

    }
    public function save (){
        // echo "register page";
        // let validate request
 
             //     $validation = $this->validate([
             // 'name'=>'required',
             // 'email'=>'required|valid_email|is_unique[users.email]',
             // 'password'=>'required|min_length[5]|max_length[12]',
             // 'cpassword'=>'required|min_length[5]||max_length[12]|matches[password]'
             //     ]);
                 $validation = $this->validate([
                     'name'=>[
                         'rule'=>'required',
                         'errors'=>[
                             'required'=>'Your full name is required'
                         ]
                         ],
                     'email'=>[
                         'rules'=>'required|valid_email|is_unique[users.email]',
                         'errors'=>[
                             'required'=>'Email is required',
                             'valid_email'=>'you must enter a valid email',
                             'is_unique'=>'Email is already taken'
                         ]
                         ],
                     'password'=>[
                         'rules'=>'required|min_length[5]|max_length[12]',
                         'errors'=>[
                             'required'=>'Password is required',
                             'min_length'=>'Password must be have atleast 5 character length',
                             'max_length'=>'Password must not have character more than 12 in length '
                         ]
                         ],
                     'cpassword'=>[
                         'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                         'errors'=>[
                             'required'=>'Confirm Password is required',
                             'min_length'=>'Confirm Password must have more atleast 5 character length',
                             'max_length'=>'Confirm_Password must not have character more than 12 in length',
                             'matches'=>'Confirm Password not matches to password'
                         ] 
                     ]
                 ]);
 
                 if(!$validation){
                  return view ('admin/register', ['validation'=>$this->validator]);
                 }else {
                     echo 'Form validated successfully';
                     //let save to db
                     $name = $this->request->getPost('name');
                     $email = $this->request->getPost('email');
                     $password = $this->request->getPost('password');
 
                     $values = [
                             'name'=>$name,
                             'email'=>$email,
                             'password'=>Hash::make($password),
                     ];
 
                     $usersModel = new \App\Models\UsersModel();
                     $query  = $usersModel->insert($values);
                     if(!$query){
                         return redirect()->back()->with('fail', 'something went wrong');
                     }else{
                         return redirect()->to('admin/login')->with('success', 'You are now registered successfully');
                     }
 
                 }
     }
     function check(){
         //echo "login successfully";
         $validation  = $this->validate([
                  'email'=>[
                         'rules'=>'required|valid_email|is_not_unique[users.email]',
                         'errors'=>[
                             'required'=>'Email is required',
                             'valid_email'=>'you must enter a valid email',
                             'is_not_unique'=>'Email is not registered'
                         ]
                         ],
                     'password'=>[
                         'rules'=>'required|min_length[5]|max_length[12]',
                         'errors'=>[
                             'required'=>'Password is required',
                             'min_length'=>'Password must be have atleast 5 character length',
                             'max_length'=>'Password must not have character more than 12 in length '
                         ]
                         ],
         ]);
         if(!$validation){
                 return view('admin/login', ['validation'=>$this->validator]);
         }else{
             //echo 'form successfully validated';
             //get registered email to dashboard.
             
            
             $email=$this->request->getPost('email');
             $password=$this->request->getPost('password');
             $usersModel = new \App\Models\UsersModel();
              //fetch user info as requested by the user
             $user_info = $usersModel->where('email', $email)->first();
             //to use password we need to check (hash) entered password and db password
             $check_password = Hash::check($password, $user_info['password']);
 
             //if password not match (user entered password and db password)
             if(!$check_password){
                 session()->setFlashdata('fail','incorrect password');
                 //return redirect()->to('admin/login')->withInput();   
                 return view('admin/login');
             }else{
                 //if valid store user id in sesseion and load dashboard
                 $user_id = $user_info['id'];
                 session()->set('loggedUser', $user_id);
                 //return redirect()->to('/admin/dashboard');
                 return view('admin/dashboard');
             }
 
         }
     }
              function logout(){
                 if(session()->has('loggedUser')){
                     session()->remove('loggedUser');
                     return redirect()->to('/auth?access=out')->with('fail', 'You logged out');
                 }
     }

  

	//--------------------------------------------------------------------

}