<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\HouseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $houseRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, HouseRepositoryInterface $houseRepositoryInterface)
    {
        $this->userRepository =$userRepositoryInterface;
        $this->houseRepository =$houseRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json($users, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $user = $this->userRepository->show($id);

        return response()->json($user, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attribute = $request->all();
        $user = $this->userRepository->update($attribute);

        return $user;
    }
     
    public function lock(Request $request){

        $id = (int) $request->id;
        if($request->locked == 0){
            $user = $this->userRepository->lock($id);
        }else{
            $user = $this->userRepository->unlock($id);
        }
        
        return response()->json($user);
    }

    public function power(Request $request){

        $id = (int) $request->id;
        if($request->role == 0){
            $user = $this->userRepository->grantAuthority($id);
        }else{
            $user = $this->userRepository->revokePowers($id);
        }
        
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function userInformation($id){
        $listHouseUser = $this->houseRepository->getHouseInUser($id);

        return view('user.UserInfo', compact('listHouseUser'));
    }

    public function getUser($id){
        // if(Auth::check() && $id == Auth::user()->id){
        //     return redirect()->route('user.information');
        // }
       $information = $this->userRepository->getUser($id);
       $houses = $this->houseRepository->getHouseInUser($id);
       
       return view('user.WallUser', compact(['information', 'houses']));
    }

    public function updateAvatar(Request $request){
        $attribute = $request->all();
        $result = false;
        if($request->hasFile('inputAvatar')){
            $result = $this->userRepository->updateAvatar($attribute);
        }

        return response()->json($result);
    }
}
