<!-- resources/views/borrows/status.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('สถานะการยืมคืน') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:w-full flex justify-center items-center mb-6 md:mb-0">
                    
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    
                    
                        @forelse ($borrows as $borrow)
                            <div class="mb-3 p-3 border rounded flex items-start">
                            
                                <div class="custom-margin-right">
                                    @if ($borrow->book && $borrow->book->cover_image)
                                        <img src="{{ asset('storage/' . $borrow->book->cover_image) }}" alt="Book Cover" class="rounded-lg" style="max-width: 300px;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                        
                                <div class="flex-grow">
                                    <div class="mb-2">
                                        @if ($borrow->book)
                                            หนังสือ: {{ $borrow->book->title }}
                                        @else
                                            หนังสือ: <span>ไม่พบข้อมูลหนังสือ</span>
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        วันที่ยืม: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d/m/Y') }}
                                    </div>
                                    <div class="mb-2">
                                        วันที่กำหนดคืน: {{ \Carbon\Carbon::parse($borrow->return_by)->format('d/m/Y') }}
                                    </div>
                                    <div class="mb-2">
                                        @if (is_null($borrow->returned_at) && \Carbon\Carbon::parse($borrow->return_by)->isPast())
                                            <span class="text-red-600">(เลยกำหนดคืน)</span>
                                        @elseif (is_null($borrow->returned_at))
                                            <span class="text-green-600">(อยู่ในช่วงการยืม)</span>
                                        @else
                                            <span class="text-gray-600">(คืนแล้วเมื่อ {{ \Carbon\Carbon::parse($borrow->returned_at)->format('d/m/Y') }})</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    <form action="{{ route('books.return', ['book' => $borrow->book_id]) }}" method="get">
                                        <button type="submit" class="btn btn-primary return-btn">คืนหนังสือ</button>
                                    </form>
                                </div>

                            </div>
                        @empty
                            <p>ไม่พบรายการยืมคืน</p>
                        @endforelse
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
.custom-margin-right {
    margin-right: 120px; /* คุณสามารถปรับระยะห่างตามต้องการ */
}
.return-btn {
    background-color: #007bff; /* สีพื้นหลัง */
    color: white; /* สีตัวอักษร */
    border: none; /* ไม่มีขอบ */
    padding: 10px 20px; /* ระยะห่างภายใน */
    font-size: 16px; /* ขนาดตัวอักษร */
    border-radius: 5px; /* มุมโค้งมน */
    cursor: pointer; /* เปลี่ยนเคอร์เซอร์เมื่อ hover */
}

.return-btn:hover {
    background-color: #0056b3; /* สีพื้นหลังเมื่อ hover */
}
.flex-grow{
    margin-left: 120px; /* คุณสามารถปรับระยะห่างตามต้องการ */
}
</style>
