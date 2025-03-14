@props([
    'title',
    'value',
    'icon',
    'change' => null,
    'trend' => 'up',
    'color' => 'indigo'
])

@php
    $colorClasses = [
        'indigo' => [
            'light' => 'bg-indigo-50',
            'medium' => 'bg-indigo-100',
            'text' => 'text-indigo-600',
            'fill' => 'from-indigo-500 to-indigo-600',
            'stroke' => 'stroke-indigo-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'purple' => [
            'light' => 'bg-purple-50',
            'medium' => 'bg-purple-100',
            'text' => 'text-purple-600',
            'fill' => 'from-purple-500 to-purple-600',
            'stroke' => 'stroke-purple-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'pink' => [
            'light' => 'bg-pink-50',
            'medium' => 'bg-pink-100',
            'text' => 'text-pink-600',
            'fill' => 'from-pink-500 to-pink-600',
            'stroke' => 'stroke-pink-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'blue' => [
            'light' => 'bg-blue-50',
            'medium' => 'bg-blue-100',
            'text' => 'text-blue-600',
            'fill' => 'from-blue-500 to-blue-600',
            'stroke' => 'stroke-blue-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'green' => [
            'light' => 'bg-green-50',
            'medium' => 'bg-green-100',
            'text' => 'text-green-600',
            'fill' => 'from-green-500 to-green-600',
            'stroke' => 'stroke-green-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'yellow' => [
            'light' => 'bg-yellow-50',
            'medium' => 'bg-yellow-100',
            'text' => 'text-yellow-600',
            'fill' => 'from-yellow-500 to-yellow-600',
            'stroke' => 'stroke-yellow-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
        'red' => [
            'light' => 'bg-red-50',
            'medium' => 'bg-red-100',
            'text' => 'text-red-600',
            'fill' => 'from-red-500 to-red-600',
            'stroke' => 'stroke-red-500',
            'trend' => [
                'up' => 'text-green-600',
                'down' => 'text-red-600'
            ]
        ],
    ];
    
    $trendIcon = $trend === 'up' ? 'trending-up' : 'trending-down';
    $trendColor = $colorClasses[$color]['trend'][$trend];
@endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500">Static Title</h3>
            <div class="flex-shrink-0 rounded-lg p-3 bg-indigo-50">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-indigo-600">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
        </div>
        
        <div class="flex items-end justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-900 mb-1">100</div>
                
                <div class="flex items-center text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                    <span class="text-xs font-medium">15%</span>
                    <span class="text-xs text-gray-500 ml-1">vs dernier mois</span>
                </div>
            </div>
            
            <div class="relative h-12 w-24">
                <div class="absolute bottom-0 inset-x-0">
                    <div class="h-8 w-full bg-indigo-50 rounded-sm opacity-30"></div>
                    <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-sm"></div>
                </div>
            </div>
        </div>
    </div>
</div>