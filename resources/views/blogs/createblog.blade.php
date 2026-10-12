<x-layouts.admin-layout>
    <div class="min-h-screen bg-neutral-950 text-slate-100 flex w-full">
        
        <!-- Sidebar Navigation (Consistent with Dashboard) -->
        <aside class="w-64 bg-neutral-900 border-r border-neutral-800 p-6 flex flex-col justify-between shrink-0 min-h-screen">
            <div>
                <h2 class="text-xl font-bold text-blue-400 mb-8 tracking-wider">Blog-posts</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="w-full text-left px-4 py-3 rounded-xl transition flex items-center gap-3 text-neutral-400 hover:text-white hover:bg-neutral-800/50">
                            <span>📊</span> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="w-full text-left px-4 py-3 rounded-xl transition flex items-center gap-3 text-neutral-400 hover:text-white hover:bg-neutral-800/50">
                            <span>👤</span> Blogs
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content Form Area -->
        <main class="grow p-10 bg-neutral-950 overflow-y-auto">
            <div class="max-w-2xl mx-auto bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl p-8">
                
                <div class="mb-6 border-b border-neutral-800 pb-4">
                    <h1 class="text-2xl font-bold text-white">Create New Blog Post</h1>
                    <p class="text-neutral-400 text-sm mt-1">Fill out the details below to publish a new post under your account.</p>
                </div>

                <!-- Validation Errors Display -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-950/50 border border-red-800 text-red-200 px-4 py-3 rounded-xl text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Create Blog Form -->
                <form action="{{ route('blogs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            value="{{ old('title') }}" 
                            required 
                            placeholder="Enter blog title..."
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-green-500 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Author</label>
                        <input 
                            type="text" 
                            name="author" 
                            value="{{ old('author') }}" 
                            required 
                            placeholder="Author name..."
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-green-500 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Content</label>
                        <textarea 
                            name="content" 
                            rows="6" 
                            required 
                            placeholder="Write your blog content here..."
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-green-500 transition resize-none"
                        >{{ old('content') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4 border-t border-neutral-800">
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="px-5 py-2.5 rounded-xl text-neutral-400 hover:bg-neutral-800 font-medium transition flex items-center"
                        >
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-xl transition cursor-pointer shadow-lg"
                        >
                            Publish Post
                        </button>
                    </div>
                </form>

            </div>
        </main>

    </div>
</x-layouts.admin-layout>