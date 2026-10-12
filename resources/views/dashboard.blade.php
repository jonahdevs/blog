<x-layouts.admin-layout>
    <div class="min-h-screen bg-neutral-950 text-slate-100 flex w-full" x-data="{ tab: 'dashboard', openModal: false, editMode: false, blogId: null, title: '', author: '', content: '' }">
        <!-- Main Content Area -->
        <main class="grow p-10 bg-neutral-950 overflow-y-auto">

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-700 text-green-200 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- DASHBOARD TAB -->
            <div x-show="tab === 'dashboard'" class="space-y-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-red-500">Welcome to the Dashboard</h1>
                        <p class="text-neutral-400 text-sm mt-1">This is the content of the dashboard page.</p>
                    </div>
                    <button type="button" @click="editMode = false; title = ''; author = ''; content = ''; openModal = true"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-xl shadow transition cursor-pointer">
                        + Create New Blog Post
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-neutral-900 border border-neutral-800 p-6 rounded-2xl shadow">
                        <p class="text-neutral-400 text-sm">Total Blogs Created</p>
                        <p class="text-3xl font-extrabold text-white mt-2">{{ $totalCreated }}</p>
                    </div>
                    <div class="bg-neutral-900 border border-neutral-800 p-6 rounded-2xl shadow">
                        <p class="text-neutral-400 text-sm">Edited Posts</p>
                        <p class="text-3xl font-extrabold text-indigo-400 mt-2">{{ $totalEdited }}</p>
                    </div>
                    <div class="bg-neutral-900 border border-neutral-800 p-6 rounded-2xl shadow">
                        <p class="text-neutral-400 text-sm">Deleted Posts</p>
                        <p class="text-3xl font-extrabold text-red-400 mt-2">{{ $totalDeleted }}</p>
                    </div>
                </div>
            </div>

            <!-- BLOGS TAB -->
            <div x-show="tab === 'blogs'" class="space-y-6" style="display: none;">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Your Blog Posts</h2>
                        <p class="text-neutral-400 text-sm mt-1">Access all the blogs created under your account.</p>
                    </div>
                    <button 
                        @click="editMode = false; title = ''; author = ''; content = ''; openModal = true" 
                        class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-xl transition cursor-pointer">
                        + Create New Blog
                    </button>
                </div>

                <div class="bg-neutral-900 border border-neutral-800 rounded-2xl overflow-hidden shadow">
                    @if($blogs->count() > 0)
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-neutral-800/50 border-b border-neutral-800 text-xs uppercase tracking-wider text-neutral-400">
                                    <th class="py-4 px-6">Title</th>
                                    <th class="py-4 px-6">Author</th>
                                    <th class="py-4 px-6">Created At</th>
                                    <th class="py-4 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-800 text-sm text-neutral-300">
                                @foreach($blogs as $blog)
                                    <tr class="hover:bg-neutral-800/30 transition">
                                        <td class="py-4 px-6 font-medium text-white">{{ $blog->title }}</td>
                                        <td class="py-4 px-6">{{ $blog->author }}</td>
                                        <td class="py-4 px-6 text-neutral-400">{{ Str::substr($blog->created_at, 0, 10) }}</td>
                                        <td class="py-4 px-6 text-right space-x-2">
                                            <!-- Edit Trigger Button -->
                                            <button 
                                                @click="editMode = true; blogId = '{{ $blog->id }}'; title = '{{ addslashes($blog->title) }}'; author = '{{ addslashes($blog->author) }}'; content = '{{ addslashes(str_replace(["\r", "\n"], ' ', $blog->content)) }}'; openModal = true"
                                                class="bg-indigo-950 hover:bg-indigo-900 text-indigo-300 px-3 py-1.5 rounded-lg text-xs font-medium cursor-pointer transition">
                                                Edit
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this blog?')" class="bg-red-950 hover:bg-red-900 text-red-300 px-3 py-1.5 rounded-lg text-xs font-medium cursor-pointer transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-12 text-center text-neutral-500">You haven't created any blogs yet.</div>
                    @endif
                </div>
            </div>

        </main>

        <!-- Dynamic Modal (Handles both Create and Update) -->
        <div x-show="openModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex justify-center items-center z-50 p-4" style="display: none;">
            <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-2xl w-full max-w-lg p-8">
                <h3 class="text-xl font-bold text-white mb-6" x-text="editMode ? 'Edit Blog Post' : 'Create New Blog Post'"></h3>
                
                <form :action="editMode ? '/blogs/' + blogId : '{{ route('blogs.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-1">Title</label>
                        <input type="text" name="title" x-model="title" required class="w-full py-2.5 px-4 bg-neutral-800 border border-neutral-700 rounded-lg text-white focus:outline-none focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-1">Author</label>
                        <input type="text" name="author" x-model="author" required class="w-full py-2.5 px-4 bg-neutral-800 border border-neutral-700 rounded-lg text-white focus:outline-none focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-300 mb-1">Content</label>
                        <textarea name="content" x-model="content" rows="4" required class="w-full py-2.5 px-4 bg-neutral-800 border border-neutral-700 rounded-lg text-white focus:outline-none focus:border-green-500 resize-none"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4 border-t border-neutral-800">
                        <button type="button" @click="openModal = false" class="px-4 py-2 rounded-xl text-neutral-400 hover:bg-neutral-800 cursor-pointer">Cancel</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2 rounded-xl cursor-pointer" x-text="editMode ? 'Update Post' : 'Publish Post'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.admin-layout>