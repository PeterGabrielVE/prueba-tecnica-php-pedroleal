<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Factories\UserFactory;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\User; 

class userController extends Controller
{
    protected $userRepository;
    protected $userFactory;
    
    public function __construct(UserRepository $userRepository, UserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return response()->json([
            'data' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                    'name' => 'required|string|max:50|unique:users',
                    'password' => 'required'
                 ]);

                 if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->messages()
                    ]);
                } 


                $user = $this->userFactory->create($request->all());
                //dd($user);
                $this->userRepository->create($user->toArray());

                return response()->json([
                    'success' => true,
                    'message' => 'Usuario '.$request->name.' creado correctamente',
                    'data' => $user
                ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        return response()->json([
            'data' => $this->userRepository->update($id, $data)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
