<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ประวัติการยืมหนังสือของฉัน') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @forelse ($borrows as $borrow)
                        <div class="flex mb-3 p-3 border rounded">
                            <div class="mr-4">
                                @if ($borrow->book && $borrow->book->cover_image)
                                    <img src="{{ asset('storage/' . $borrow->book->cover_image) }}" alt="Book Cover" class="w-40 h-40 object-cover">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>
                            <div>
                                <div class="mb-2">
                                    @if ($borrow->book)
                                        <p>หนังสือ: {{ $borrow->book->title }}</p>
                                    @else
                                        <p>หนังสือ: <span>ไม่พบข้อมูลหนังสือ</span></p>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <p>วันที่ยืม: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d/m/Y') }}</p>
                                </div>
                                <div class="mb-2">
                                    <p>วันที่กำหนดคืน: {{ \Carbon\Carbon::parse($borrow->return_by)->format('d/m/Y') }}</p>
                                </div>
                                <div class="mb-2">
                                    @if (is_null($borrow->returned_at) && \Carbon\Carbon::parse($borrow->return_by)->isPast())
                                        <span class="text-red-600">(เลยกำหนดคืน)</span>
                                    @elseif (is_null($borrow->returned_at))
                                        <span class="text-green-600">(อยู่ในช่วงการยืม)</span>
                                    @else
                                        <span class="text-gray-600">คืนเมื่อ: {{ \Carbon\Carbon::parse($borrow->returned_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>ไม่พบประวัติการยืมหนังสือ</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .mr-4 {
        margin-right: 20px; /* คุณสามารถปรับระยะห่างตามต้องการ */
    }

    .mb-3 {
        margin-bottom: 20px; /* ปรับระยะห่างของแต่ละกล่องข้อมูลด้านล่าง */
    }
</style>
    
