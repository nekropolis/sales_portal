<?php

namespace Modules\Users\UseCases;

use App\Traits\Makeable;
use Illuminate\Http\Request;
use Modules\Users\Models\User;

class getTableUsersUseCase
{
    use Makeable;

    public function execute(Request $request)
    {
        $data = $request->all();

        if ($data['search'] == '') {
            $users = User::query()
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = User::all()->count();
        } else {
            $users = User::query()
                ->where('name', 'LIKE', "%{$data['search']}%")
                ->orWhere('email', 'LIKE', "%{$data['search']}%")
                ->limit($data['limit'])
                ->offset($data['offset'])
                ->get();

            $count = User::where('name', 'LIKE', "%{$data['search']}%")->get()->count();
        }

        return response()->json([
            'total'            => $count,
            'totalNotFiltered' => $count,
            'rows'             => $users,
        ]);
    }
}