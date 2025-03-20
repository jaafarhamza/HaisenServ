@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('header-title', 'Dashboard')

@section('content')
    <!-- Welcome Card -->
    <div class="card mb-6 bg-gradient-to-r from-bgPrimary to-bgSecondary border border-highlight border-opacity-20">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-textHeading mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                    <p class="text-textParagraph">
                        Here's what's happening with <span class="text-highlight font-medium">HaisenServ</span> today.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.roles.index') }}" class="btn-primary">
                            <i class="fas fa-user-shield mr-2"></i> Manage Roles
                        </a>
                        <a href="{{ route('admin.permissions.index') }}" class="btn-secondary">
                            <i class="fas fa-key mr-2"></i> Manage Permissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    @php
        $stats = [
            [
                'title' => 'Total Users',
                'value' => $usersCount,
                'icon' => 'users',
                'color' => 'highlight',
                'change' => $usersChange,
            ],
            [
                'title' => 'Admin Users',
                'value' => $adminCount,
                'icon' => 'user-shield',
                'color' => 'tertiary',
                'change' => $adminChange ?? 0,
            ],
            [
                'title' => 'Provider Users',
                'value' => $providerCount,
                'icon' => 'user-tie',
                'color' => 'blue-500',
                'change' => $providerChange ?? 0,
            ],
            [
                'title' => 'Clients',
                'value' => $clientCount,
                'icon' => 'user',
                'color' => 'purple-500',
                'change' => $clientCount ?? 0,
            ],
            [
                'title' => 'Users Without Roles',
                'value' => $usersWithoutRolesCount,
                'icon' => 'user-slash',
                'color' => 'red-500',
                'change' => $usersWithoutRolesChange ?? 0,
            ],
        ];
    @endphp

    @include('admin.partials.stats-cards', ['stats' => $stats])

    <!-- Recent Activity and User Roles -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Recent Activity -->
        <div class="lg:col-span-2">
            @component('admin.components.card')
                @slot('header')
                    Recent Activity
                @endslot

                <div class="space-y-4">
                    {{-- @forelse($recentActivities as $activity)
                        <div class="flex items-start">
                            <div class="h-10 w-10 rounded-full bg-bgPrimary mr-4 flex-shrink-0 flex items-center justify-center">
                                @if ($activity->log_name == 'user')
                                    <i class="fas fa-user text-highlight"></i>
                                @elseif($activity->log_name == 'role')
                                    <i class="fas fa-user-shield text-tertiary"></i>
                                @elseif($activity->log_name == 'permission')
                                    <i class="fas fa-key text-blue-500"></i>
                                @elseif($activity->log_name == 'service')
                                    <i class="fas fa-concierge-bell text-purple-500"></i>
                                @elseif($activity->log_name == 'booking')
                                    <i class="fas fa-calendar-check text-yellow-500"></i>
                                @else
                                    <i class="fas fa-bell text-gray-500"></i>
                                @endif
                            </div>
                            <div>
                                <p class="text-textParagraph">
                                    <span class="font-medium text-textHeading">{{ $activity->causer->name ?? 'System' }}</span>
                                    {{ $activity->description }}
                                    <span class="font-medium text-textHeading">{{ $activity->subject->name ?? '' }}</span>
                                </p>
                                <span class="text-xs text-secondary">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty --}}
                    <div class="flex flex-col items-center justify-center py-6">
                        <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-history text-secondary text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-textHeading mb-1">No recent activity</h3>
                        <p class="text-textParagraph">Activities will appear here as you use the system.</p>
                    </div>
                    {{-- @endforelse --}}
                </div>

                {{-- @if ($recentActivities->isNotEmpty())
                    @slot('footer')
                        <div class="text-center">
                            <a href="#" class="text-highlight hover:underline">
                                View All Activity <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @endslot
                @endif --}}
            @endcomponent
        </div>

        <!-- User Roles Distribution -->
        <div>
            @component('admin.components.card')
                @slot('header')
                    User Roles Distribution
                @endslot

                <div class="space-y-4">
                    @foreach ($roleDistribution as $role)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <div class="flex items-center">
                                    @php
                                        $colors = [
                                            'admin' => 'highlight',
                                            'provider' => 'tertiary',
                                            'client' => 'blue-500',
                                        ];
                                        $color = $colors[$role['name']] ?? 'gray-500';
                                    @endphp
                                    <div class="h-3 w-3 rounded-full bg-{{ $color }} mr-2"></div>
                                    <span class="text-sm font-medium text-textHeading">{{ ucfirst($role['name']) }}</span>
                                </div>
                                <span class="text-sm text-textParagraph">{{ $role['count'] }}
                                    ({{ $role['percentage'] }}%)</span>
                            </div>
                            <div class="h-2 bg-bgPrimary rounded-full overflow-hidden">
                                <div class="h-full bg-{{ $color }}" style="width: {{ $role['percentage'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @slot('footer')
                    <div class="text-center">
                        <a href="#" class="text-highlight hover:underline">
                            Manage Users <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endslot
            @endcomponent

            <!-- Quick Links -->
            @component('admin.components.card', ['class' => 'mt-6'])
                @slot('header')
                    Quick Links
                @endslot

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.roles.index') }}"
                        class="p-4 bg-bgPrimary rounded-lg hover:bg-opacity-80 transition-all flex flex-col items-center justify-center">
                        <div class="h-12 w-12 rounded-full bg-highlight bg-opacity-20 flex items-center justify-center mb-2">
                            <i class="fas fa-user-shield text-highlight"></i>
                        </div>
                        <span class="text-sm font-medium text-textHeading">Roles</span>
                    </a>

                    <a href="{{ route('admin.permissions.index') }}"
                        class="p-4 bg-bgPrimary rounded-lg hover:bg-opacity-80 transition-all flex flex-col items-center justify-center">
                        <div class="h-12 w-12 rounded-full bg-tertiary bg-opacity-20 flex items-center justify-center mb-2">
                            <i class="fas fa-key text-tertiary"></i>
                        </div>
                        <span class="text-sm font-medium text-textHeading">Permissions</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="p-4 bg-bgPrimary rounded-lg hover:bg-opacity-80 transition-all flex flex-col items-center justify-center">
                        <div class="h-12 w-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center mb-2">
                            <i class="fas fa-users text-blue-500"></i>
                        </div>
                        <span class="text-sm font-medium text-textHeading">Users</span>
                    </a>

                    <a href="#"
                        class="p-4 bg-bgPrimary rounded-lg hover:bg-opacity-80 transition-all flex flex-col items-center justify-center">
                        <div class="h-12 w-12 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center mb-2">
                            <i class="fas fa-concierge-bell text-purple-500"></i>
                        </div>
                        <span class="text-sm font-medium text-textHeading">Services</span>
                    </a>
                </div>
            @endcomponent
        </div>
    </div>
@endsection
