<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function index(Request $request){
    
        $query = User::query();
        
        // Apply role filter if selected
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        // Apply search if provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        
        // Get users with pagination
        $users = $query->orderBy('id', 'desc')->paginate(10);
        
        // Get all available roles for filter dropdown
        $roles = [
            'admin' => 'Admin',
            'director' => 'Director',
            'executive' => 'Executive',
            'subexecutive' => 'Sub Executive',
            'customer' => 'Customer',
        ];
        
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                Rule::unique('users'),
            ],
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,director,executive,subexecutive',
            'points' => 'required|integer|min:0',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = [
            'admin' => 'Admin',
            'director' => 'Director',
            'executive' => 'Executive',
            'subexecutive' => 'Sub Executive'
        ];
        
        return response()->json($user);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,director,executive,subexecutive',
            'points' => 'required|integer|min:0',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Update user role only.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,director,executive,subexecutive'
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User role updated successfully.');
    }

    /**
     * Update user points only.
     */
    public function updatePoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:0'
        ]);

        $user = User::findOrFail($id);
        $user->points = $request->points;
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User points updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
  public function create()
{
       // Get main user data from users table
        // $user = User::findOrFail($userId);
        // $profile = UsersProfile::where('user_id', $userId)->first();
        // $addresses = Address::where('user_id', $userId)->get();
        // $documents = Document::where('user_id', $userId)->get();
    return view('admin.users.create');
}
}
