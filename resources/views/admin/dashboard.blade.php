@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg">
            <div class="absolute top-0 right-0 w-40 h-40 transform translate-x-8 -translate-y-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-full h-full text-white opacity-10">
                    <circle cx="12" cy="12" r="10" fill="currentColor" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-8 translate-y-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-full h-full text-white opacity-10">
                    <path d="M0 0L24 12L0 24Z" fill="currentColor" />
                </svg>
            </div>
            <div class="relative p-6 sm:p-8 text-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold tracking-tight">Bienvenue, Admin</h2>
                        <p class="mt-1 text-indigo-100">Voici un aperçu de la plateforme HaisenServ</p>
                    </div>
                    <div class="flex space-x-3">
                        <div class="relative">
                            <button class="flex items-center text-sm font-medium text-white bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Cette semaine
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 ml-2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </div>
                        
                        <button class="flex items-center text-sm font-medium text-white bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @include('admin.components.stats-card', [
                'title' => 'Utilisateurs Total',
                'value' => '150',
                'icon' => 'users',
                'change' => '5.2',
                'trend' => 'up',
                'color' => 'indigo'
            ])
            
            @include('admin.components.stats-card', [
                'title' => 'Prestataires',
                'value' => '55',
                'icon' => 'briefcase',
                'change' => '3.1',
                'trend' => 'up', 
                'color' => 'purple'
            ])
            
            @include('admin.components.stats-card', [
                'title' => 'Réservations',
                'value' => '55', 
                'icon' => 'calendar',
                'change' => '8.7',
                'trend' => 'up',
                'color' => 'green'
            ])
            
            @include('admin.components.stats-card', [
                'title' => 'Litiges Actifs',
                'value' => '55',
                'icon' => 'alert-triangle',
                'change' => '2.5',
                'trend' => 'down',
                'color' => 'red'
            ])
        </div>

        <!-- Analytics Section -->
        @include('admin.partials._analytics')

        <!-- Two Column Layout: Pending Services & Disputes -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                @include('admin.partials._pending-services')
            </div>
            <div>
                {{-- @include('admin.partials._disputes') --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any dashboard-specific JavaScript here
        const allCharts = document.querySelectorAll('[data-chart]');
        allCharts.forEach(initializeChart);
        
        function initializeChart(chartElement) {
            const chartType = chartElement.getAttribute('data-chart');
            const ctx = chartElement.getContext('2d');
            
            // Different chart initializations based on type
            switch(chartType) {
                case 'activity':
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                            datasets: [
                                {
                                    label: 'Réservations',
                                    data: [65, 59, 80, 81, 56, 55, 70],
                                    borderColor: '#4f46e5',
                                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                },
                                {
                                    label: 'Nouveaux utilisateurs',
                                    data: [28, 48, 40, 19, 36, 27, 45],
                                    borderColor: '#8b5cf6',
                                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                    break;
                    
                case 'categories':
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Services domestiques', 'Services professionnels', 'Beauté', 'Santé', 'Autres'],
                            datasets: [{
                                data: [35, 25, 20, 15, 5],
                                backgroundColor: [
                                    '#4f46e5',
                                    '#8b5cf6',
                                    '#ec4899',
                                    '#06b6d4',
                                    '#10b981'
                                ],
                                borderWidth: 1,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                }
                            },
                            cutout: '70%'
                        }
                    });
                    break;
            }
        }
    });
</script>
@endpush