@extends('seller.layouts.layout')
@section('seller_page_title')
    Manage Store
@endsection
@section('seller_layout')

<style>
    body { font-family: "Poppins", sans-serif; background: #f5f6fa; margin: 0; padding: 0; }
    .store-container { width: 95%; max-width: 1100px; background: #fff; padding: 25px; margin: 40px auto; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .store-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .store-header h2 { font-size: 22px; color: #333; }
    .btn-add { background-color: #3c91e6; color: #fff; padding: 10px 18px; border-radius: 8px; border: none; text-decoration: none; font-size: 15px; transition: background 0.3s ease; }
    .btn-add:hover { background-color: #2c76c3; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    thead { background-color: #3c91e6; color: #fff; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #ddd; }
    tbody tr:hover { background-color: #f1f7ff; }
    .store-logo { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    .action-btns { display: flex; gap: 8px; align-items: center; }
    .btn-edit { background-color: #28a745; color: white; padding: 6px 12px; font-size: 14px; border-radius: 6px; border: none; cursor: pointer; transition: 0.3s ease; text-decoration: none; }
    .btn-edit:hover { background-color: #218838; }
    .btn-delete { background-color: #dc3545; color: white; padding: 6px 12px; font-size: 14px; border-radius: 6px; border: none; cursor: pointer; transition: 0.3s ease; }
    .btn-delete:hover { background-color: #c82333; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb; border-radius: 5px; }
    .alert-error, .alert-info { background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px; }

    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr { display: block; }
        thead { display: none; }
        tr { background: #fff; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 10px; }
        td { display: flex; justify-content: space-between; padding: 8px 0; border: none; }
        td::before { content: attr(data-label); font-weight: 600; color: #333; }
        .action-btns { justify-content: flex-end; }
    }
</style>

<div class="store-container">
    <div class="store-header">
        <h2>Manage Your Stores</h2>
        <a href="{{ route('store.create') }}" class="btn-add">+ Create New Store</a>
    </div>

    {{-- Session Messages --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error') || session('info'))
        <div class="alert-error">
            {{ session('error') ?? session('info') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Store Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through the stores fetched from the controller --}}
            @forelse ($stores as $store)
                <tr>
                    <td data-label="ID">{{ $store->id }}</td>
                    <td data-label="Logo">
                        {{-- Use asset() to link to the public folder image path --}}
                        @if($store->store_logo)
                            <img src="{{ asset($store->store_logo) }}" class="store-logo" alt="{{ $store->store_name }} Logo">
                        @else
                            N/A
                        @endif
                    </td>
                    <td data-label="Store Name">{{ $store->store_name }}</td>
                    <td data-label="Email">{{ $store->store_email ?? 'N/A' }}</td>
                    <td data-label="Phone">{{ $store->store_phone ?? 'N/A' }}</td>
                    <td data-label="Status">{{ $store->store_status }}</td>
                    <td data-label="Actions">
                        <div class="action-btns">
                            {{-- Edit Button --}}
                            <a href="" class="btn-edit">Edit</a>

                            {{-- Delete Button --}}
                            <form action="{{ route('store.destroy', $store->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি এই দোকানটি মুছে ফেলতে চান?');">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">কোনো দোকান খুঁজে পাওয়া যায়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
