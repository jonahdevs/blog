<x-layouts.admin-layout>
    <div class="min-h-screen bg-neutral-950 text-slate-100 flex w-full">

        <!-- Main Content Form Area -->
        <main class="grow p-10 bg-neutral-950 overflow-y-auto">
            <div class="max-w-2xl mx-auto bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl p-8">
                
                <div class="mb-6 border-b border-neutral-800 pb-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit Blog Post</h1>
                        <p class="text-neutral-400 text-sm mt-1">Modify the information below to update your post.</p>
                    </div>
                    <a href="{{ route('blogs.user.list') }}" class="bg-neutral-800 hover:bg-neutral-700 text-neutral-300 font-medium px-4 py-2 rounded-xl transition text-sm">
                        &larr; Back
                    </a>
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

                <!-- Edit Blog Form -->
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            value="{{ old('title', $blog->title) }}" 
                            required 
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-indigo-500 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Author</label>
                        <input 
                            type="text" 
                            name="author" 
                            value="{{ old('author', $blog->author) }}" 
                            required 
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-indigo-500 transition"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-2">Content</label>
                        <textarea 
                            name="content" 
                            rows="6" 
                            required 
                            class="w-full py-3 px-4 bg-neutral-800 border border-neutral-700 rounded-xl text-white placeholder-neutral-500 focus:outline-none focus:border-indigo-500 transition resize-none"
                        >{{ old('content', $blog->content) }}</textarea>
                    </div>

                   <div class="flex justify-end space-x-4 pt-4 border-t border-neutral-800">
                        <a 
                            href="{{ route('blogs.user.list') }}" 
                            class="px-5 py-2.5 rounded-xl text-neutral-400 hover:bg-neutral-800 font-medium transition flex items-center"
                        >
                            Cancel
                        </a>

                        <!-- Reset Button to clear current edits back to original loaded blog values -->
                        <button 
                            type="reset" 
                            class="bg-neutral-800 hover:bg-neutral-700 text-neutral-300 font-medium px-5 py-2.5 rounded-xl transition cursor-pointer"
                        >
                            Reset
                        </button>

                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl transition cursor-pointer shadow-lg"
                        >
                            Update Post
                        </button>
                    </div>
                </form>

            </div>
        </main>

    </div>
</x-layouts.admin-layout>