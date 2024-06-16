<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{

    public function destroy()
    {
        $user = Auth::User();
    // Hapus semua relasi atau data terkait jika diperlukan
        $user->delete();

    // Logout user setelah menghapus akun (opsional)
        Auth::logout();

    // Redirect ke halaman lain setelah penghapusan akun
        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:1024',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('Y-m-d') . '-' . $image->getClientOriginalName();
            $path = 'profile_images/' . $filename;

            // Simpan file ke storage
            Storage::disk('public')->put($path, file_get_contents($image));

            // Simpan path gambar ke database
            $user->image = $path;
        }


        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
