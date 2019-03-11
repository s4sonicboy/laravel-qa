<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use File;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        // GET DATA FROM MODEL
        $user = "Hello World";
        //$user = User::get()->toArray();
        // echo "<pre>";print_r($user);exit;
        $user = User::with('books')->get()->toArray();
        $name = $user;
        //dd($name);
        //return view("welcome")->with("name", $user); // this with() get value with key
        //return view("welcome")->with(compact("name")); // this with(compact()) function get value without key
        //return view("welcome",compact("name")); // this direct compact() function get value without key
        return view("b_forms", ["name" => $user]); // this this array method get value with key
    }

    public function userdata(Request $request)
    {
        $data = $request->all();
        //dd($data);

        // FOR IMAGE
        $imgName = "";
        if ($request->hasFile("userImg")) {
            # GET FILE
            $fileDetail = $request->file('userImg');
            $fileName = $fileDetail->getClientOriginalName(); // GET FILE ORIGNAL NAME
            $fileExt = $fileDetail->getClientOriginalExtension(); // GET FILE EXTENSION

            if ($fileExt == 'jpg' || $fileExt == "png" || $fileExt == "jpeg") {
                // RENAME THE
                $imgName = uniqid() . $fileName;
                // DESTINATION PATH
                $destpath = public_path('/pro_data/');

                $fileDetail->move($destpath, $imgName);
            } else {
                # code...
                $request->session()->flash('alert-danger', "Image Type Not Valid. Upload jpg, png, jpeg");
                return redirect()->back();
            }

            $request->hasFile('key');

        } else {
            # code...
            // RENAME THE
            $imgName = "";
        }

        // $data = $request->input('name_user');
        //print_r($data);exit;
        if (!empty($data['name_user']) || !empty($data['mobile_user']) || !empty($data['email'])) {
            # code...
            // echo "<pre>";print_r($data);exit;
            try {
                /* DB::table('users')->insert([ 'name'=>$data['name_user'], 'mobile'=> $data['mobile_user'], 'email'=> $data['email'] ]);*/
                //User::create([ 'name'=>$data['name_user'], 'mobile'=> $data['mobile_user'], 'email'=> $data['email'] ]);
                $user = new User();
                $user->name = $data['name_user'];
                $user->mobile = $data['mobile_user'];
                $user->email = $data['email'];
                $user->password = $data['password'];
                $user->user_img = $imgName;
                $user->save();

                // SAVE USER'S BOOK DATA
                $book = new Book();
                $book->book = $data['userBook'];
                $book->userid_fk = $user->id;
                $book->save();

            } catch (\Exception $e) {
                // $request->session()->flash('alert-danger','Registeration Faild');
                $request->session()->flash('alert-danger', $e->getMessage());
                return redirect()->back();
            }
            $request->session()->flash('alert-success', 'User Added Sucessfully');
            return redirect()->back();
        } else {
            # code...
            $request->session()->flash('alert-danger', 'Registeration Faild! Please Fill The All Required Feilds.');
            return redirect()->back();
        }

    }

    public function editusers($id = null)
    {
        // echo $id;exit;
        $userData = User::with('books')->where('id', $id)->first()->toArray();
        // echo "<pre>";print_r($userData);
        return view("edit_user")->with("userData", $userData);
    }

    public function update_userdata(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);exit;
        //$userBook = Book::select('id')->where('userid_fk', $request['userID'])->first()->toArray();
        $userBook = Book::select('id')->where('userid_fk', $request['userID'])->count();
        //dd($userBook);

        // FOR IMAGE
        $imgName = "";
        if ($request->hasFile("userImg")) {
            # GET OLD IMAGE AND DELETE IT
            $oldImgFullPath = public_path('/pro_data/') . $request['hideImg'];
            File::delete($oldImgFullPath);

            # GET FILE
            $fileDetail = $request->file('userImg');
            $fileName = $fileDetail->getClientOriginalName(); // GET FILE ORIGNAL NAME
            $fileExt = $fileDetail->getClientOriginalExtension(); // GET FILE EXTENSION
            if ($fileExt == 'jpg' || $fileExt == "png" || $fileExt == "jpeg") {
                // RENAME THE
                $imgName = uniqid() . $fileName;
                // DESTINATION PATH
                $destpath = public_path('/pro_data/');

                $fileDetail->move($destpath, $imgName);
            } else {
                # code...
                $request->session()->flash('alert-danger', "Image Type Not Valid. Upload jpg, png, jpeg");
                return redirect()->back();
            }

            $request->hasFile('key');

        } else {
            # code...
            // RENAME THE
            $imgName = $request['hideImg'];
        }

        try {
            User::where('id', $request['userID'])
                ->update([
                    'name' => $request['name_user'],
                    'mobile' => $request['mobile_user'],
                    'email' => $request['email'],
                    'password' => $request['password'],
                    'user_img' => (!empty($imgName)) ? $imgName : "",
                ]);

            if ($userBook > 0) {

                // UPDATE USER'S BOOK DATA
                Book::where('userid_fk', $request['userID'])
                    ->update(['book' => $request['userBook']]);
            }
            else {
                // SAVE USER'S BOOK DATA
                $book = new Book();
                $book->book = $request['userBook'];
                $book->userid_fk = $request['userID'];
                $book->save();
            }

            $request->session()->flash('alert-success', 'User Updated Sucessfully');
        } catch (\Exception $e) {
            $request->session()->flash('alert-danger', 'Updation Faild');
        }
        return redirect()->to('/');
    }

    public function delete_user_data(Request $request, $id = null)
    {
        //echo $id;exit;
        try {
            User::where('id', $id)->delete();
            $request->session()->flash('alert-danger', 'User Delete Sucessfully');
        } catch (Exception $e) {
            //throw $th;
            $request->session()->flash('alert-danger', 'Delete Action Faild');
        }
        return redirect()->to('/');
    }

}
