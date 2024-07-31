<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'asc');
        $searchKeyword = $request->input('searchKeyword');
        $page = $request->input('page', 1);

        $query = User::query();

        if ($searchKeyword) {
            $query->where('name', 'LIKE', "%{$searchKeyword}%")
                  ->orWhere('email', 'LIKE', "%{$searchKeyword}%");
        }

        $users = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);

        if ($users->isEmpty() && $page > 1) {
            $page--;
            $users = $query->orderBy($sort, $direction)->paginate(20, ['*'], 'page', $page);
        }

        return view('user_page', compact('users', 'sort', 'direction', 'searchKeyword', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $page = ceil(User::count() / 20);
            return redirect()->route('user.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        try {
            $user->update($data);
            $page = ceil(User::where('id', '<=', $id)->count() / 20);
            return redirect()->route('user.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $page = $request->input('page', 1);

        try {
            $user->delete();
            $totalPages = ceil(User::count() / 20);

            if ($page > $totalPages) {
                $page = $totalPages > 0 ? $totalPages : 1;
            }

            return redirect()->route('user.index', ['page' => $page, 'sort' => 'created_at', 'direction' => 'asc'])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
