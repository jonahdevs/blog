<x-layouts.admin-layout>
    <div class="space-y-6 max-w-5xl mx-auto py-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-white">Your Blog Posts</h1>
                <p class="text-neutral-400 text-sm mt-1">Manage and view all articles published under your account.</p>
            </div>
            <a href="{{ route('blogs.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2.5 rounded-xl transition shadow">
                + Create New Blog
            </a>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl overflow-hidden shadow-xl">
            @if(isset($blogs) && $blogs->count() > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-neutral-800/50 border-b border-neutral-800 text-xs uppercase tracking-wider text-neutral-400">
                            <th class="py-4 px-6">Title</th>
                            <th class="py-4 px-6">Author</th>
                            <th class="py-4 px-6">Published Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800 text-sm text-neutral-300">
                        @foreach($blogs as $blog)
                            <tr class="hover:bg-neutral-800/30 transition">
                                <td class="py-4 px-6 font-medium text-white">
                                    <a href="{{ route('blogs.show', $blog->id) }}" class="hover:underline text-blue-400">
                                        {{ $blog->title }}
                                    </a>
                                </td>
                                <td class="py-4 px-6">{{ $blog->author }}</td>
                                <td class="py-4 px-6 text-neutral-400">{{ $blog->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="text-indigo-400 hover:underline text-xs font-medium px-2.5 py-1 bg-indigo-950/50 rounded-lg border border-indigo-800/50">Edit</a>
                                    
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" class="text-red-400 hover:underline text-xs font-medium px-2.5 py-1 bg-red-950/50 rounded-lg border border-red-800/50 cursor-pointer">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-12 text-center text-neutral-500">
                    <p class="text-base">No blog posts found.</p>
                    <p class="text-sm mt-1 text-neutral-600">Get started by creating your first blog article!</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin-layout>