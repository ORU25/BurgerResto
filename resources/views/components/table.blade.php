<div class="rounded-lg">
    <table class="min-w-full whitespace-nowrap" id="{{ $id }}">
        <thead>
            <tr class="text-center font-bold bg-slate-500 text-slate-200">
                {{ $header }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>