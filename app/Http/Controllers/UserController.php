<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Notifications\NewUserPasswordCreate;
use App\Services\DataTable\DataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTable = (new DataTable(
            User::select(User::$defaultSelectFields)
        ))
            ->setColumn('id', '#', true, true)
            ->setColumn('name', __('Name'), true, true)
            ->setColumn('email', __('Email'), true, true)
            ->setColumn('created_at', __('Date'), true, true)
            ->setColumn('action', __('Action'))
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();

        return Inertia::render('Users/Index', compact('dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $validatedRequest = $request->validated();

            $user = new User();
            $user->fill($validatedRequest);
            $user->password = Hash::make(Str::random(15));
            $user->creator_id = auth()->id();
            $user->save();

            //            $token = app('auth.password.broker')->createToken($user);
            //            Notification::send($user, new NewUserPasswordCreate($token));

            DB::commit();

            return redirect()->route('users.edit', ['user' => $user->id])->with('success', __('The record has been successfully created.'));
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors([__('Error creating record.')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string  $id
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     */
    public function destroy(string $id)
    {
    }
}
