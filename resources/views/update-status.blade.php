<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Project Status') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <form action="{{ route('update-status', ['id' => $project->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <select name="contract_status" id="contract_status">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ $status === old('contract_status', $project->contract_status) ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            
            @if(old('contract_status') === 'completed')
            <div class="mb-4">
                <label for="total_price" class="block font-medium text-sm text-gray-700">Total Price</label>
                <input type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" name="total_price" id="total_price" required>
            </div>
            
            <div class="mb-4">
                <label for="completion_date" class="block font-medium text-sm text-gray-700">Completion Date</label>
                <input type="date" class="form-input rounded-md shadow-sm mt-1 block w-full" name="completion_date" id="completion_date" required>
            </div>
            @endif
            
            <button type="submit" class="btn btn-primary" style="background-color: #337ab7; color: #fff;">Update Status</button>
        </form>
        
        @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
        @endif
    </div>
</x-app-layout>
