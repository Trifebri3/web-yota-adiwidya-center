<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GenPostController extends Controller
{
    // 1. INDEX: Daftar postingan milik sendiri
    public function index()
    {
        $posts = Post::with(['category', 'author'])
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);

        return view('general.posts.index', compact('posts'));
    }

    // 2. CREATE: Form tambah
    public function create()
    {
        $categories = Category::all();
        return view('general.posts.create', compact('categories'));
    }

    // 3. STORE: Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'type' => 'required|in:article,journal,opinion,story',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $wordCount = str_word_count(strip_tags($request->content));
        $readingTime = ceil($wordCount / 200);

        $imagePath = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('posts/covers', 'public')
            : null;

        $post = Post::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . Str::random(5),
            'excerpt'     => Str::limit(strip_tags($request->content), 150),
            'content'     => $request->content,
            'cover_image' => $imagePath,
            'type'        => $request->type,
            'status'      => $request->status ?? 'draft',
            'reading_time'=> $readingTime,
            'published_at'=> $request->status == 'published' ? now() : null,
        ]);

        if ($request->type == 'journal') {
            PostMeta::create([
                'post_id' => $post->id,
                'doi' => $request->doi,
                'issn' => $request->issn,
                'references' => $request->references,
            ]);
        }

        return redirect()->route('gen-posts.index')->with('success', 'Masterpiece created!');
    }

    // 4. EDIT: Cari manual lewat ID
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ((int) $post->user_id !== (int) auth()->id()) {
            abort(403, 'Gagal: Anda ID ' . auth()->id() . ' tapi pemiliknya ID ' . $post->user_id);
        }

        $categories = Category::all();
        return view('general.posts.edit', compact('post', 'categories'));
    }

    // 5. UPDATE: Cari manual lewat ID
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ((int) $post->user_id !== (int) auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('cover_image')) {
            if($post->cover_image) Storage::disk('public')->delete($post->cover_image);
            $post->cover_image = $request->file('cover_image')->store('posts/covers', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
        ]);

        return redirect()->route('gen-posts.index')->with('success', 'Masterpiece updated!');
    }

    // 6. DESTROY: Cari manual lewat ID
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ((int) $post->user_id !== (int) auth()->id()) {
            abort(403, 'Aksi ilegal terdeteksi.');
        }

        if($post->cover_image) Storage::disk('public')->delete($post->cover_image);

        $post->delete();

        return redirect()->route('gen-posts.index')->with('success', 'Masterpiece deleted!');
    }
}
