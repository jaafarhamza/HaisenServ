@extends('admin.layouts.app')

@section('title', $service->title)
@section('header-title', 'View Service')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-textHeading">{{ $service->title }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.services.edit', $service) }}" class="btn-primary">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.services.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Services
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Service Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Main Card -->
        <div class="card">
            <div class="px-6 py-4 border-b border-secondary">
                <h2 class="text-xl font-bold text-textHeading">Service Details</h2>
            </div>
            <div class="p-6">
                <!-- Status Badge -->
                <div class="mb-6">
                    <span class="badge {{ $service->status_badge_class }} text-white px-3 py-1">
                        {{ $service->status_label }}
                    </span>
                </div>
                
                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-textHeading mb-2">Description</h3>
                    <div class="text-textParagraph">
                        {{ $service->description }}
                    </div>
                </div>
                
                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-textHeading mb-2">Details</h3>
                        <ul class="space-y-2">
                            <li class="flex justify-between">
                                <span class="text-secondary">Price:</span>
                                <span class="font-medium text-textHeading">{{ $service->formatted_price }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">Category:</span>
                                <span class="font-medium text-highlight">
                                    @if($service->category)
                                        {{ $service->category->name }}
                                    @else
                                        <span class="text-gray-400">None</span>
                                    @endif
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">Provider:</span>
                                <span class="font-medium text-textHeading">
                                    @if($service->user)
                                        {{ $service->user->name }}
                                    @else
                                        <span class="text-gray-400">Unknown</span>
                                    @endif
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">Created:</span>
                                <span class="font-medium text-textHeading">{{ $service->creation_date->format('M d, Y H:i') }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">Last Updated:</span>
                                <span class="font-medium text-textHeading">{{ $service->updated_at->format('M d, Y H:i') }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">ID:</span>
                                <span class="font-medium text-textHeading">{{ $service->id }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-secondary">Slug:</span>
                                <span class="font-medium text-textHeading">{{ $service->slug }}</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-textHeading mb-2">Actions</h3>
                        <div class="space-y-4">
                            <form action="{{ route('admin.services.changeStatus', $service) }}" method="POST" class="flex flex-col space-y-2">
                                @csrf
                                <div class="flex space-x-2">
                                    <select name="status" class="input-field flex-grow">
                                        <option value="draft" @if($service->status == 'draft') selected @endif>Draft</option>
                                        <option value="pending" @if($service->status == 'pending') selected @endif>Pending Approval</option>
                                        <option value="active" @if($service->status == 'active') selected @endif>Active</option>
                                        <option value="inactive" @if($service->status == 'inactive') selected @endif>Inactive</option>
                                        <option value="rejected" @if($service->status == 'rejected') selected @endif>Rejected</option>
                                    </select>
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-sync-alt mr-2"></i> Update Status
                                    </button>
                                </div>
                            </form>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-tertiary flex-grow text-center">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger flex-grow">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SEO Information -->
        <div class="card">
            <div class="px-6 py-4 border-b border-secondary">
                <h2 class="text-xl font-bold text-textHeading">SEO Information</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-secondary mb-1">Meta Title</h4>
                            <p class="text-textHeading">{{ $service->meta_title ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-secondary mb-1">Meta Keywords</h4>
                            <p class="text-textHeading">{{ $service->meta_keywords ?? 'Not set' }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Meta Description</h4>
                        <p class="text-textHeading">{{ $service->meta_description ?? 'Not set' }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">City</h4>
                        <p class="text-textHeading">{{ $service->city }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-secondary mb-1">OG Title</h4>
                            <p class="text-textHeading">{{ $service->og_title ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-secondary mb-1">OG Image URL</h4>
                            <p class="text-textHeading break-all">{{ $service->og_image_url ?? 'Not set' }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">OG Description</h4>
                        <p class="text-textHeading">{{ $service->og_description ?? 'Not set' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Canonical URL</h4>
                        <p class="text-textHeading break-all">{{ $service->canonical_url ?? 'Not set' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Provider Info -->
        <div class="card">
            <div class="px-6 py-4 border-b border-secondary">
                <h2 class="text-xl font-bold text-textHeading">Provider Information</h2>
            </div>
            <div class="p-6">
                @if($service->user)
                    <div class="flex items-center mb-4">
                        <div class="avatar mr-4">
                            {{ substr($service->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-textHeading">{{ $service->user->name }}</h3>
                            <p class="text-secondary text-sm">{{ $service->user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-secondary pt-4 mt-4">
                        <a href="{{ route('admin.users.show', $service->user) }}" class="text-highlight hover:underline block text-center">
                            <i class="fas fa-user mr-2"></i> View Provider Profile
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="h-16 w-16 rounded-full bg-bgPrimary mx-auto flex items-center justify-center mb-4">
                            <i class="fas fa-user-slash text-secondary text-2xl"></i>
                        </div>
                        <p class="text-textParagraph mb-2">No provider associated with this service.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="card">
            <div class="px-6 py-4 border-b border-secondary">
                <h2 class="text-xl font-bold text-textHeading">Quick Stats</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-secondary">Bookings</span>
                    {{-- <span class="text-textHeading font-bold">
                        @php
                            $bookingsCount = $service->bookings()->count() ?? 0;
                        @endphp
                        {{ $bookingsCount }}
                    </span> --}}
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary">Rating</span>
                    {{-- <span class="text-textHeading font-bold">
                        @php
                            $avgRating = $service->ratings()->avg('score') ?? 0;
                            $ratingsCount = $service->ratings()->count() ?? 0;
                        @endphp
                        <i class="fas fa-star text-yellow-500 mr-1"></i> 
                        {{ number_format($avgRating, 1) }} ({{ $ratingsCount }})
                    </span> --}}
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary">Revenue</span>
                    <span class="text-textHeading font-bold">
                        {{-- @php
                            $revenue = $service->bookings()->sum('amount') ?? 0;
                        @endphp --}}
                        {{-- {{ number_format($revenue, 2) }} --}}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Related Services -->
        <div class="card">
            <div class="px-6 py-4 border-b border-secondary">
                <h2 class="text-xl font-bold text-textHeading">Related Services</h2>
            </div>
            <div class="p-6">
                @if($service->category)
                    @php
                        $relatedServices = App\Models\Service::where('category_id', $service->category_id)
                            ->where('id', '!=', $service->id)
                            ->take(3)
                            ->get();
                    @endphp
                    
                    @if($relatedServices->count() > 0)
                        <div class="space-y-4">
                            @foreach($relatedServices as $relatedService)
                                <div class="border-b border-secondary pb-4 last:border-0 last:pb-0">
                                    <a href="{{ route('admin.services.show', $relatedService) }}" class="text-highlight hover:underline font-medium">
                                        {{ $relatedService->title }}
                                    </a>
                                    <p class="text-sm text-secondary">{{ Str::limit($relatedService->description, 60) }}</p>
                                    <div class="flex justify-between mt-2">
                                        <span class="text-xs text-tertiary font-medium">{{ number_format($relatedService->price, 2) }} $</span>
                                        <span class="text-xs badge text-white
                                            @if($relatedService->status == 'draft') bg-gray-500
                                            @elseif($relatedService->status == 'pending') bg-yellow-500
                                            @elseif($relatedService->status == 'active') bg-green-500
                                            @elseif($relatedService->status == 'inactive') bg-red-500
                                            @else bg-gray-500 @endif">
                                            {{ ucfirst($relatedService->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.services.index', ['category_id' => $service->category_id]) }}" class="text-highlight hover:underline">
                                View All in {{ $service->category->name }} <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-textParagraph">No related services found.</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <p class="text-textParagraph">No category assigned to this service.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Handle status update form submission with confirmation
    const statusForm = document.querySelector('form[action*="changeStatus"]');
    if (statusForm) {
        statusForm.addEventListener('submit', function(e) {
            const newStatus = this.querySelector('select[name="status"]').value;
            const currentStatus = "{{ $service->status }}";
            
            if (newStatus !== currentStatus) {
                if (!confirm(`Are you sure you want to change the status to ${newStatus}?`)) {
                    e.preventDefault();
                }
            }
        });
    }
</script>
@endpush