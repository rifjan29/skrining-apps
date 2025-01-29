<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')->latest()->get();
        return view('dashboard.user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
        ]);
        try {
            $role = Role::where('name', $request->get('role'))->first();
            DB::beginTransaction();
            $user = new User;
            $user->name = $request->get('nama');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();
            if ($role) {
                $user->assignRole($role);
            }
            DB::commit();
            return redirect()->route('user.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('dashboard.user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value !== $user->email && User::where('email', $value)->exists()) {
                        $fail('Email sudah digunakan oleh pengguna lain.');
                    }
                },
            ],
        ]);
        try {
            DB::beginTransaction();
            $update = User::find($id);
            $update->name = $request->get('nama');
            $update->email = $request->get('email');
            if ($request->has('password') || $request->get('password') != '') {
                $update->password = Hash::make($request->get('password'));
            }
            $update->update();
            if ($request->has('role') && $request->get('role') != null)  {
                DB::commit();
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $user->assignRole($request->input('role'));
                return redirect()->route('user.index')->withStatus('Berhasil mengganti hak akses data');
            }
            DB::commit();
            if (Auth::user()->role == 'Admin') {
                return redirect()->route('user.index')->withStatus('Berhasil mengganti data.');
            }
            return redirect()->back();
        } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            User::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('user.index')->withStatus('Berhasil menghapus data.');
         } catch (Exception $th) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        }
    }
}
