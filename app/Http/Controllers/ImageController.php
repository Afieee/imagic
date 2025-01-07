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
            'rights' =>   'nullable|string',

        ]);
        $postingan = Post::with('user')->get();

        // Ambil path file yang di-upload
        $imagePath = $request->file('image')->path();
        $watermarkPath = $request->file('watermark') ? $request->file('watermark')->path() : null;

        // Ambil nama file asli dan ekstensi
        $originalImageName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $imageExtension = $request->file('image')->getClientOriginalExtension();

        // Generate nama file unik menggunakan nama asli + timestamp atau uniqid
        $watermarkedImageName = $originalImageName . 'watermarked' . uniqid() . '.' . $imageExtension;

        // Tentukan path lengkap untuk menyimpan gambar yang sudah di-watermark
        $watermarkedImagePath = storage_path('app/public/' . $watermarkedImageName);

        try {
            // Add watermark if provided
            $watermarkedImage = $watermarkPath
                ? $this->imageService->addWatermark($imagePath, $watermarkPath)
                : file_get_contents($imagePath); // Use the original image if no watermark

            // Simpan gambar yang sudah di-watermark dengan nama dinamis
            file_put_contents($watermarkedImagePath, $watermarkedImage);

            // Get metadata
            $metadata = $this->imageService->getMetadata($watermarkedImagePath);

            // Generate hashtags
            $hashtags = $this->imageService->generateHashtags($imagePath);

            // Get user ID from authenticated session
            $userId = Auth::user()->id;
            $user = $request->session()->get('user');

            // Prepare data for the post table
            $postData = [
                'post_image' => 'storage/' . $watermarkedImageName, // Image name dengan path yang disesuaikan
                'post_image_file_size' => $metadata['data']['FileSize'], // File size from metadata
                'post_image_extension' => $metadata['data']['FileTypeExtension'], // File extension from metadata
                'post_image_size' => $metadata['data']['ImageSize'], // Image dimensions from metadata
                'post_caption' => $request->input('caption', ''), // Caption, default empty if not provided
                'post_status' => 'Published', // Default status
                'post_hashtags' => implode(' ', $hashtags['tags'] ?? []), // Store hashtags in the post
                'user_id' => $userId, // User ID from session
            ];

            // Insert data into the post table
            Post::create($postData);

            return view('home', [
                'watermarkedImagePath' => asset('storage/' . $watermarkedImageName),
                'metadata' => $metadata,
                'hashtags' => $hashtags['tags'] ?? [],
                'caption' => $postData['post_caption'],
                'user' => $user,
                'postingan' => $postingan,

            ])->with('success', 'Post successfully published!');;
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|array', // Pastikan input berupa array untuk mendukung banyak file
            'image.*' => 'image', // Validasi tiap file sebagai image
            'watermark' => 'nullable|image', // Watermark opsional
            'caption' => 'nullable|string', // Validasi caption
            'rights' =>   'nullable|string',

        ]);

        // Menyimpan banyak gambar
        $imagePaths = [];
        foreach ($request->file('image') as $image) {
            // Generate nama unik untuk setiap gambar agar tidak tertimpa
            $imageName = uniqid('image_') . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('post_images', $imageName, 'public'); // Menyimpan gambar dengan nama unik
            $imagePaths[] = $imagePath; // Menyimpan path gambar untuk digunakan nanti
        }

        $watermarkPath = $request->file('watermark') ? $request->file('watermark')->path() : null;

        try {
            // Proses setiap gambar yang di-upload
            foreach ($imagePaths as $imagePath) {
                // Menambahkan watermark jika ada
                $watermarkedImage = $watermarkPath
                    ? $this->imageService->addWatermark(storage_path('app/public/' . $imagePath), $watermarkPath)
                    : file_get_contents(storage_path('app/public/' . $imagePath)); // Jika tidak ada watermark, gunakan gambar asli

                // Nama baru untuk gambar watermarked agar tidak tertimpa
                // Ambil nama file asli untuk watermark dan tambah prefix agar unik
                $watermarkedImageName = 'watermarked_' . basename($imagePath);
                $watermarkedImagePath = storage_path('app/public/post_images/' . $watermarkedImageName);
                file_put_contents($watermarkedImagePath, $watermarkedImage);

                // Mendapatkan metadata gambar
                $metadata = $this->imageService->getMetadata($watermarkedImagePath);

                // Menghasilkan hashtags (opsional)
                $hashtags = $this->imageService->generateHashtags($watermarkedImagePath);

                // Mendapatkan ID pengguna dari session
                $userId = Auth::user()->id;

                // Menyusun data untuk tabel post
                $postData = [
                    'post_image' => 'post_images/' . $watermarkedImageName, // Path gambar yang sudah di-watermark
                    'post_image_file_size' => $metadata['data']['FileSize'],
                    'post_image_extension' => $metadata['data']['FileTypeExtension'],
                    'post_image_size' => $metadata['data']['ImageSize'],
                    'post_caption' => $request->input('caption', ''),
                    'post_status' => 'Published',
                    'user_id' => $userId,
                    'post_hashtags' => implode(' ', $hashtags['tags'] ?? []), // Menyimpan hashtags
                ];

                Post::create($postData);
            }

            return redirect('/home')->with('success', 'Post successfully published!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
