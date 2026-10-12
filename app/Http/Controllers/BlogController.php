<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $blogs = Blog::where('user_id', $userId)->latest()->get();

        $totalCreated = $blogs->count();
        $totalEdited = $blogs->filter(fn($blog) => $blog->updated_at > $blog->created_at)->count();
        $totalDeleted = Blog::where('user_id', $userId)->onlyTrashed()->count();

        return view('dashboard', compact('blogs', 'totalCreated', 'totalEdited', 'totalDeleted'));
    }

    /**
     * Display a list of blogs created by the logged-in user.
     */
    public function userBlogs(Request $request)
    {
        $userId = $request->user()->id;
        $blogs = Blog::where('user_id', $userId)->latest()->get();

        return view('blogs.index', compact('blogs'));
    }

    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $request->user()->blogs()->create($validated);

        return redirect()->back()->with('success', 'Blog post created successfully!');
    }

    public function home()
    {
        $blogs = Blog::latest()->get();

        return view('home', compact('blogs'));
    }

    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $blog->update($validated);

       return redirect()->route('blogs.user.list')->with('success', 'Blog post updated successfully!');
    }

    public function edit(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('blogs.edit', compact('blog'));
    }

    public function destroy(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $blog->delete();

        return redirect()->back()->with('success', 'Blog post deleted successfully!');
    }
}