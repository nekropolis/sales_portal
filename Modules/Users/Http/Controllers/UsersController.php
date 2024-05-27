<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Modules\Users\UseCases\getTableUsersUseCase;

class UsersController extends Controller
{
    use ResponseTrait;

    public function listUsers()
    {
        return view('users::users');
    }

    public function getTableUsers(Request $request, getTableUsersUseCase $useCase){
        try {
            return $useCase->execute($request);
        } catch (\Exception $e) {
            return $this->responseUnprocessable(['Can\'t get messages'.$e->getMessage()]);
        }
    }


    public function showUser($id)
    {
        return view('users::show');
    }

    public function editUser($id)
    {
        return view('users::edit');
    }

    public function deleteUser(Request $request)
    {
        $data = $request->all();

        $seller = User::findOrFail($data['user_id']);
        $seller->delete();

        return redirect()->back()->with('success', 'deleted successfully.');
    }
}
