<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-secondary">
        <thead class="bg-bgPrimary">
            <tr>
                {{ $header }}
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary">
            {{ $slot }}
        </tbody>
    </table>
</div>

@if(isset($pagination))
    <div class="p-4 flex items-center justify-between border-t border-secondary">
        {{ $pagination }}
    </div>
@endif