<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function halamanCreate(Request $request)
    {
        $user = $request->session()->get('user');


        return view('image.upload', [
            'user' => $user,
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'watermark' => 'nullable|image',
            'caption' => 'nullable|string',
            'rights' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->path();
        $watermarkPath = $request->file('watermark') ? $request->file('watermark')->path() : null;

        $originalImageName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $imageExtension = $request->file('image')->getClientOriginalExtension();
        $watermarkedImageName = $originalImageName . 'watermarked' . uniqid() . '.' . $imageExtension;
        $watermarkedImagePath = storage_path('app/public/' . $watermarkedImageName);

        try {
            $watermarkedImage = $watermarkPath
                ? $this->imageService->addWatermark($imagePath, $watermarkPath)
                : file_get_contents($imagePath);
            file_put_contents($watermarkedImagePath, $watermarkedImage);

            // Coba dapatkan metadata, jika gagal set null
            try {
                $metadata = $this->imageService->getMetadata($watermarkedImagePath);
            } catch (\Exception $e) {
                $metadata = null;
            }

            // Coba dapatkan hashtags, jika gagal set null
            try {
                $hashtags = $this->imageService->generateHashtags($imagePath);
            } catch (\Exception $e) {
                $hashtags = null;
            }

            $userId = Auth::id();
            $postData = [
                'post_image' => 'storage/' . $watermarkedImageName,
                'post_image_file_size' => $metadata['data']['FileSize'] ?? null,
                'post_image_extension' => $metadata['data']['FileTypeExtension'] ?? null,
                'post_image_size' => $metadata['data']['ImageSize'] ?? null,
                'post_caption' => $request->input('caption', ''),
                'post_status' => 'Published',
                'post_hashtags' => isset($hashtags['tags']) ? implode(' ', $hashtags['tags']) : null,
                'user_id' => $userId,
            ];

            Post::create($postData);

            return redirect()->route('home')->with([
                'watermarkedImagePath' => asset('storage/' . $watermarkedImageName),
                'metadata' => $metadata,
                'hashtags' => $hashtags['tags'] ?? [],
                'caption' => $postData['post_caption'],
                'success' => 'Post successfully published!',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('halaman-home')->withErrors(['error' => $e->getMessage()]);
        }
    }













































    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|array', // Pastikan input berupa array untuk mendukung banyak file
    //         'image.*' => 'image', // Validasi tiap file sebagai image
    //         'watermark' => 'nullable|image', // Watermark opsional
    //         'caption' => 'nullable|string', // Validasi caption
    //         'rights' => 'nullable|string',
    //     ]);

    //     // Menyimpan banyak gambar
    //     $imagePaths = [];
    //     foreach ($request->file('image') as $image) {
    //         // Generate nama unik untuk setiap gambar agar tidak tertimpa
    //         $imageName = uniqid('image_') . '.' . $image->getClientOriginalExtension();
    //         $imagePath = $image->storeAs('post_images', $imageName, 'public'); // Menyimpan gambar dengan nama unik
    //         $imagePaths[] = $imagePath; // Menyimpan path gambar untuk digunakan nanti
    //     }

    //     $watermarkPath = $request->file('watermark') ? $request->file('watermark')->path() : null;

    //     try {
    //         // Proses setiap gambar yang di-upload
    //         foreach ($imagePaths as $imagePath) {
    //             // Menambahkan watermark jika ada
    //             $watermarkedImage = $watermarkPath
    //                 ? $this->imageService->addWatermark(storage_path('app/public/' . $imagePath), $watermarkPath)
    //                 : file_get_contents(storage_path('app/public/' . $imagePath)); // Jika tidak ada watermark, gunakan gambar asli

    //             // Nama baru untuk gambar watermarked agar tidak tertimpa
    //             $watermarkedImageName = 'watermarked_' . basename($imagePath);
    //             $watermarkedImagePath = storage_path('app/public/post_images/' . $watermarkedImageName);
    //             file_put_contents($watermarkedImagePath, $watermarkedImage);

    //             // Mendapatkan metadata gambar
    //             $metadata = $this->imageService->getMetadata($watermarkedImagePath);

    //             // Menghasilkan hashtags (opsional)
    //             $hashtags = $this->imageService->generateHashtags($watermarkedImagePath);

    //             // Mendapatkan ID pengguna dari session
    //             $userId = Auth::user()->id;

    //             // Menyusun data untuk tabel post
    //             $postData = [
    //                 'post_image' => 'post_images/' . $watermarkedImageName, // Path gambar yang sudah di-watermark
    //                 'post_image_file_size' => $metadata['data']['FileSize'],
    //                 'post_image_extension' => $metadata['data']['FileTypeExtension'],
    //                 'post_image_size' => $metadata['data']['ImageSize'],
    //                 'post_caption' => $request->input('caption', ''),
    //                 'post_status' => 'Published',
    //                 'user_id' => $userId,
    //                 'post_hashtags' => implode(' ', $hashtags['tags'] ?? []), // Menyimpan hashtags
    //             ];

    //             Post::create($postData);
    //         }

    //         // Ambil data user dan postingan untuk dikirim ke view
    //         $user = Auth::user();
    //         $data = Post::where('user_id', $user->id)->get(); // Mengambil postingan milik user

    //         return view('home', [
    //             'user' => $user,
    //             'postingan' => $data,
    //         ]);
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }
}
