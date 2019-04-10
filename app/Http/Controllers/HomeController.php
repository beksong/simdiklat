<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // untuk menampilkan profile
    public function profile()
    {
        $user=\Auth::user();
        return view('profile.profile',compact('user'));
    }

    public function update(Request $req)
    {
        $foto=$req->file('foto');
        $filename=preg_replace('/\s+/','_',$foto->getClientOriginalName());
        $user=\Auth::user();

        // check if file exist in storage and delete old file
        $storage=Storage::disk('profile');
        if($user->photo!==null){
            $storage->delete($user->photo);
        }

        $user->update([
            'name' => $req->get('name'),
            'email' => $req->get('email'),
            'nip' => $req->get('nip'),
            'place_birth' => $req->get('tempat_lahir'),
            'date_birth' => $req->get('tanggal_lahir'),
            'gender' => $req->get('jenis_kelamin'),
            'address' => $req->get('address'),
            'photo' => $filename
        ]);
        
        // storing file
        $storage->put($filename,file_get_contents($foto));

        return redirect()->back()->with('message','Berhasil merubah profile anda');
    }

    public function getprofilepicture($picture)
    {
        $picture = Storage::url($picture);
        return $picture;
    }

}
