@extends('admin.layouts.app')

@section('title', 'Services Management')
@section('header-title', 'Services Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-textHeading">Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn-primary">
        <i class="fas fa-plus mr-2"></i> Add New Service
    </a>
</div>

<!-- Filters -->
<div class="card mb-6">
    <div class="p-6">
        <form action="{{ route('admin.services.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-textParagraph mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Title or description..."
                    class="input-field w-full">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-textParagraph mb-1">Category</label>
                <select name="category_id" id="category_id" class="input-field w-full">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-textParagraph mb-1">Status</label>
                <select name="status" id="status" class="input-field w-full">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $key => $value)
                        <option value="{{ $key }}" @if(request('status') == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="btn-primary h-10 w-full">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Services List -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-secondary">
            <thead class="bg-bgSecondary">
                <tr>
                    <th scope="col" class="table-header">#</th>
                    <th scope="col" class="table-header">Title</th>
                    <th scope="col" class="table-header">Category</th>
                    <th scope="col" class="table-header">Provider</th>
                    <th scope="col" class="table-header">Price</th>
                    <th scope="col" class="table-header">Status</th>
                    <th scope="col" class="table-header">Created</th>
                    <th scope="col" class="table-header">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-secondary">
                @forelse($services as $service)
                    <tr>
                        <td class="table-cell">{{ $service->id }}</td>
                        <td class="table-cell font-medium">{{ $service->title }}</td>
                        <td class="table-cell">
                            @if($service->category)
                                <span class="badge badge-primary">{{ $service->category->name }}</span>
                            @else
                                <span class="text-gray-400">None</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if($service->user)
                                {{ $service->user->name }}
                            @else
                                <span class="text-gray-400">Unknown</span>
                            @endif
                        </td>
                        <td class="table-cell">{{ $service->formatted_price }}</td>
                        <td class="table-cell">
                            <span class="badge {{ $service->status_badge_class }} text-white">
                                {{ $service->status_label }}
                            </span>
                        </td>
                        <td class="table-cell">{{ $service->creation_date->format('M d, Y') }}</td>
                        <td class="table-cell">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.services.show', $service) }}" class="text-highlight hover:text-opacity-80">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-tertiary hover:text-opacity-80">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-opacity-80">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="table-cell text-center py-8">
                            <div class="flex flex-col items-center justify-center">
                                <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-concierge-bell text-secondary text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-textHeading mb-1">No services found</h3>
                                <p class="text-textParagraph mb-4">There are no services matching your criteria.</p>
                                <a href="{{ route('admin.services.create') }}" class="btn-primary">
                                    <i class="fas fa-plus mr-2"></i> Create Service
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-4">
        {{ $services->withQueryString()->links() }}
    </div>
</div>
@endsection